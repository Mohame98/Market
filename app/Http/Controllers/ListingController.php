<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\ListingHelper;

class ListingController extends Controller
{
    use ListingHelper;

    public function index()
    {
        $user = Auth::user();
        $watchlist = $this->getUserWatchlist();
        $listings = Listing::with('trader')->latest()->simplePaginate(6);
        $this->homeTruncateListings($listings);
    
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
       $watchlist = $this->getUserWatchlist();
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

        $imgPath = $request->file('listing_img')->store('listing_imgs', 'public');

        $trader = Auth::user()->trader->id;

        $attributes['trader_id'] = $trader;
        $attributes['listing_img'] = $imgPath;

        Listing::create($attributes);

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

    public function items(Listing $listings)
    {
        $user = Auth::user();
        if ($user) {
            $listings = Listing::where('trader_id', $user->trader->id)->simplePaginate(12);
            $this->itemTruncateListings($listings);
            return view('listings.items', ['listings' => $listings]);
        }
    } 
}