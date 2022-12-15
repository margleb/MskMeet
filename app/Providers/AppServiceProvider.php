<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        // сервис по созданию рандомных поль-лей
        Http::macro('RandomUser', function () {
            return Http::withHeaders([
                'content-type' => 'application/json',
            ])->baseUrl('https://randomuser.me/');
        });

        // сервис по историческим местам
        Http::macro('OpenTripMap', function () {
            return Http::withHeaders([
                'content-type' => 'application/json',
            ])->baseUrl('https://api.opentripmap.com');
        });
    }
}
