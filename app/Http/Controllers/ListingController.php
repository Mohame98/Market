<?php

namespace App\Http\Controllers;

use App\Mail\ContactNoti;
use App\Mail\ListingPosted;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Trader;
use App\Models\User;
use App\Models\watchlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $watchlist = null;
        
        if ($user) {
            $traderId = $user->trader->id;  
            $watchlist = Watchlist::where('trader_id', $traderId)->get();
        }

        $listings = Listing::with('trader')->latest()->simplePaginate(6);
        foreach ($listings as $listing) {
            $listing->truncatedDescription = Str::limit($listing->description, 55);
            $listing->truncatedTitle = Str::limit($listing->title, 20);
            $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
            $listing->truncatedPrice = Str::limit($listing->price, 6);
        }
    
        return view('listings.index', [
            'listings' => $listings,
            'user' => $user,
            'watchlist' => $watchlist,
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function show(Listing $listing)
    {
        $user = Auth::user();
    
        if ($user->id == $user->trader->user_id) {
            $traderId = $user->trader->id;
            $watchlist = Watchlist::where('trader_id', $traderId)->get();
        }

        return view('listings.show', [
            'listing' => $listing,
            'watchlist' => $watchlist
        ]);
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:199'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999.99'],
            'location' => ['required', 'max:199'],
            'description' => ['required', 'max:400'],
            'listing_img' => ['required','image', 'mimes:jpeg,png,jpg,webp,gif', 'max:2048'],
        ]);

        // old way
        // $imgPath = $request->listing_img->store('listing_imgs', 'public');
        
        $imgPath = $request->file('listing_img')->store('listing_imgs', 'public');

        $trader = Auth::user()->trader;

        $attributes['trader_id'] = $trader->id;
        $attributes['listing_img'] = $imgPath;

        $listing = Listing::create($attributes);

        // Mail::to($listing->trader->user->email)->send(
        //     new ListingPosted($listing)
        // );

        return redirect('/');
    }

    public function update(listing $listing, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:199',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'location' => 'required|max:199',
            'description' => 'required|max:400',
            'listing_img' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        if ($request->hasFile('listing_img')) {
            if ($listing->listing_img) {
                Storage::disk('public')->delete($listing->listing_img);
            }
            $imgPath = $request->file('listing_img')->store('listing_imgs', 'public');
            $validatedData['listing_img'] = $imgPath;
        }

        $listing->update($validatedData);
    
        return redirect('/listings/' . $listing->id);
    }

    public function destroyConfirmation(listing $listing)
    {
        return view('listings.destroy-confirmation', ['listing' => $listing]);
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/');
    }

    public function items(Listing $listing)
    {
        $user = Auth::user();
        if ($user->trader) {
            $traderId = $user->trader->id;
            $listings = Listing::where('trader_id', $traderId)->get();
            foreach ($listings as $listing) {
                $listing->truncatedTitle = Str::limit($listing->title, 20);
                $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
                $listing->truncatedPrice = Str::limit($listing->price, 6);
            }
            return view('listings.items', ['listings' => $listings]);
        }
    }
}