<?php
namespace App\Http\Controllers;
use App\Models\Listing;
use App\Http\Controllers\Traits\ListingHelper;

class SearchController extends Controller
{
    use ListingHelper;
    public function __invoke()
    {
        $watchlist = $this->getUserWatchlist();
        $listings = Listing::where('title', 'LIKE', '%'.request('query').'%')->simplePaginate(15);
        $this->itemTruncateListings($listings);

        return view('listings.find', [
            'listings' => $listings,
            'watchlist' => $watchlist
        ]);
    }
}
