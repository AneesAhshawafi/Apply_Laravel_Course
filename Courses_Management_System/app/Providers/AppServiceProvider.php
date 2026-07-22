<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;

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
        // Ensure PHP default timezone matches application timezone
        date_default_timezone_set(config('app.timezone'));
        // Auth-aware rate limits: grouped by authenticated User ID, falling back to IP for guests.
        // This ensures different logged-in users sharing the same network/IP have separate limits.
        RateLimiter::for('limit3', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());
        });
        RateLimiter::for('limit4', function (Request $request) {
            return Limit::perMinute(4)->by($request->user()?->id ?: $request->ip());
        });

        // IP-only rate limit: omitting `by()` defaults to client IP.
        // Users sharing the same IP will share this limit, regardless of authentication state.
        RateLimiter::for('per-user', function (Request $request) {
            return Limit::perMinute(60);
        });

        // Global rate limit: grouped by a static string key so that
        // all requests across the entire application share a single rate limit bucket.
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(100)->by('global-key');
        });

        // Lesson 104:
        // Response Macros
        // If you would like to define a custom response that you can re-use in a variety of your 
        // routes and controllers, you may use the macro method on the Response facade. 
        // Typically, you should call this method from the boot method of one of your 
        // application's service providers, such as the App\Providers\AppServiceProvider service provider:
        Response::macro('caps', function (string $value) {
            return Response::make(strtoupper($value));
        });
    }
}
