<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;
use App\Models\Listing;
use Illuminate\Support\Str;

class WatchlistController extends Controller
{
    public function toggleWatchlist(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        $listingId = $request->input('listing_id');
        $user = Auth::user();
        $traderId = $user->trader->id;

        $watchlistItem = Watchlist::where('trader_id', $traderId)
                                ->where('listing_id', $listingId)
                                ->first();

        if ($watchlistItem) {
            $watchlistItem->delete();
            return response()->json([
                'isAdded' => false,
                'message' => 'Watchlist removed'
            ], 200);
        } else {
            Watchlist::create([
                'trader_id' => $traderId,
                'listing_id' => $listingId,
            ]);
            return response()->json([
                'isAdded' => true,
                'message' => 'Watchlist added'
            ], 200);
        }
    }

    public function watchListShow()
    {
        $user = Auth::user();
        $traderId = $user->trader->id;

        $watchlists = Watchlist::where('trader_id', $traderId)->get();

        $listings = $watchlists->map(function ($watchlist) {
            return $watchlist->listing;
        });

        foreach ($listings as $listing) {
            $listing->truncatedTitle = Str::limit($listing->title, 20);
            $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
            $listing->truncatedPrice = Str::limit($listing->price, 6);
        }

        return view('listings.watchlist', [
            'listings' => $listings,
            'watchlist' => $watchlists
        ]);
        
    }
}