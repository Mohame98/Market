<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $traderId = $user->trader->id;
        $watchlist = Watchlist::where('trader_id', $traderId)->get();
  
        $listings = $watchlist->map(function ($watchlist) {
            return $watchlist->listing;
        });
     
        $listings = Listing::where('title', 'LIKE', '%'.request('query').'%')->get();

        foreach ($listings as $listing) {
            $listing->truncatedTitle = Str::limit($listing->title, 20);
            $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
            $listing->truncatedPrice = Str::limit($listing->price, 6);
        }

        return view('listings.find', [
            'listings' => $listings,
            'watchlist' => $watchlist
        ]);
    }
}
