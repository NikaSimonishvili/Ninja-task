<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Guards\TokenGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::provider('access_token', function (Application $app, array $config) {

            return new CustomTokenProvider();
        });

        Auth::extend('access_token', function ($app, $name, array $config) {
            $provider = new CustomTokenProvider();

            return new TokenGuard($provider, $app['request']);
        });
    }
}
