<?php

namespace App\Providers;

use App\Models\Listing;
use App\Models\User;
use App\Services\WatchlistService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    
    }
    
    public function boot(): void
    {
        Gate::define('edit-listing', function (User $user, Listing $listing) {
            return $listing->trader->user->is($user);
        });
    }
}
