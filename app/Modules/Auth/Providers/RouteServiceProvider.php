<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('api')
            ->prefix('api/auth')
            ->group(base_path('app/Modules/Auth/routes.php'));
    }
}
