<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;
use Illuminate\Support\Str;

trait ListingHelper
{
    protected function getAuthenticatedUser()
    {
        return Auth::user();
    }

    protected function getUserWatchlist()
    {
        $user = $this->getAuthenticatedUser();
        if ($user) {
            return Watchlist::where('trader_id', $user->trader->id)->get();
        }
        return null;
    }

    protected function homeTruncateListings($listings)
    {
        foreach ($listings as $listing) {
            $listing->truncatedDescription = Str::limit($listing->description, 55);
            $listing->truncatedTitle = Str::limit($listing->title, 20);
            $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
            $listing->truncatedPrice = Str::limit($listing->price, 6);
        }
    }

    public function itemTruncateListings($listings)
    {
        if ($listings->count() > 0) {
            foreach ($listings as $listing) {
                $listing->truncatedTitle = Str::limit($listing->title, 20);
                $listing->trader->truncatedUsername = Str::limit($listing->trader->username, 20);
                $listing->truncatedPrice = Str::limit($listing->price, 6);
            }
        }
    }
}