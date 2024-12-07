<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisteredController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'], 
        ]);

        $traderAttributes = $request->validate(['username' => ['required']]);
        $user = User::create($userAttributes);
        $user->trader()->create($traderAttributes);

        return redirect('/login');
    }
}
