<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $unreadNotificationsCount = 0;
            if (Auth::check()) {
                $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();
            }
            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
    }
}
