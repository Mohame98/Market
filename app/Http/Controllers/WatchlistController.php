<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ListingHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;
use App\Models\Listing;


class WatchlistController extends Controller
{
    use ListingHelper;
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
        $watchlists = $this->getUserWatchlist();
        $listings = Listing::whereIn('id', $watchlists->pluck('listing_id'))->simplePaginate(12);

        $this->itemTruncateListings($listings);
        return view('listings.watchlist', [
            'listings' => $listings,
            'watchlist' => $watchlists
        ]);  
    }
}