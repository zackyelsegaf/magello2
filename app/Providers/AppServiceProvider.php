<?php

namespace App\Providers;

use App\Models\BookingKavling;
use App\Observers\BookingKavlingObserver;
use App\Models\Kapling;
use App\Observers\KaplingObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auth::loginUsingId(64);
        // Auth::loginUsingId(15);
        BookingKavling::observe(BookingKavlingObserver::class);
        Kapling::observe(KaplingObserver::class);

    }
}
