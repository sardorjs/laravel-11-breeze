<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
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
        // Gate::define('view_user', function(User $user){
        //     return $user->id === 3;
        // });

        // Gate::define('look_as_user', function(User $user){
        //     return $user->id === 3 
        //                         ? Response::allow() 
        //                         : Response::deny('You must be $user->id = 3!');
        // });

        // Gate::define('deny_with_404', function(User $user){
        //     return $user->id === 2
        //                         ? Response::allow()
        //                         : Response::denyWithStatus(404);
        // });

        // Gate::before(function (User $user) {
        //     return $user->id === 3;
        // });

    }
}
