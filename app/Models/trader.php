<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Listing;
use App\Models\User;


class Trader extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    } 

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class, 'trader_id');
    }
}