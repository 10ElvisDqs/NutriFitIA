<?php

namespace App\Providers;

use App\Services\OpenAiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
         // Registra el servicio en el contenedor de servicios
        $this->app->singleton(OpenAiService::class, function ($app) {
            return new OpenAiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
