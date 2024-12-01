<?php

namespace App\Models;

use App\Models\Trader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class, 'listing_id');
    }
}
