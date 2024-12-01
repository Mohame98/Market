<?php

namespace App\Http\Controllers;

use App\Mail\ContactNoti;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactMe(Request $request, Listing $listing)
    {
        $user = Auth::user();
        Mail::to($listing->trader->user->email)->queue(
            new ContactNoti($listing)
        );

        return view('mail.contactNoti', [
            'listing' => $listing,
            'user' => $user
        ]);
    }
}
