<?php

namespace App\Providers;

use App\Events\CoffeeBeanUpdated;
use App\Models\CoffeeBean;
use App\Models\CoffeeGrade;
use Illuminate\Support\Facades\Log;
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
        //
    }
}
