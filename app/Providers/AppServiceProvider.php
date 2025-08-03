<?php

namespace App\Providers;

use App\Interfaces\ConcessionRepositoryInterface;
use App\Repositories\ConcessionRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ConcessionRepositoryInterface::class,ConcessionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', 'on'); // Pagination Links support HTTPS
            URL::forceScheme('https');
        }
    }
}
