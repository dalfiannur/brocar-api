<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Response::macro('validationError', function (MessageBag $errors) {
            return Response::make([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $errors
            ], 422);
        });

        Response::macro('success', function ($data) {
            return Response::make([
                'status' => 200,
                'data' => $data
            ]);
        });

        Response::macro('notFound', function ($message) {
            return Response::make([
                'status' => 404,
                'message' => $message
            ], 404);
        });

        Response::macro('error', function (String $message, Int $status = 400) {
            return Response::make([
                'status' => $status,
                'message' => $message
            ], $status);
        });
    }
}
