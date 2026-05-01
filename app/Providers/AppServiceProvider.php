<?php

namespace App\Providers;

use App\Models\Leads;
use App\Policies\LeadsPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Leads::class, LeadsPolicy::class);
        // if (config('app.env') === 'production') {
        //     URL::forceScheme('https');
        // }
    }
}
