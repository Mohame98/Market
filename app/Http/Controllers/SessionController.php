<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or pass',
            ]);
        }
        $request->session()->regenerate();
        return redirect('/');
    }

    public function edit()
    {
        return view("auth.edit");
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }
    
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        $user->save();
        return redirect('/auth/edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed|',
        ]);

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
            $user->save();
        }
        return redirect('/auth/edit')->with('success', 'Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $trader = $user->trader;

        if ($trader) { $trader->delete(); }

        $user->delete();
        return redirect('/');
    }

    public function deleteConfirmation()
    {
        return view('auth.delete-confirmation');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}