<?php

namespace App\Providers;

use App\Repositories\Contracts\QRCodeRepoInterface;
use App\Repositories\QRCodeRepo;
use App\Services\Contracts\QRCodeServiceInterface;
use App\Services\QRCodeServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(QRCodeRepoInterface::class, QRCodeRepo::class);
        $this->app->bind(QRCodeServiceInterface::class, QRCodeServiceImpl::class);
            
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
