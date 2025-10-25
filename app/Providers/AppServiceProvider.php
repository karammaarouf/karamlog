<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\Permission;

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
        foreach (Permission::where('is_active', true)->pluck('name') as $perm) {
            Gate::define($perm, function ($user) use ($perm) {
                return $user->hasPermission($perm);
            });
        }

        Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });
    }
}
