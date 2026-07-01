<?php

namespace App\Providers;

use App\Repositories\Contracts\QRCodeRepoInterface;
use App\Repositories\QRCodeRepo;
use App\Services\Contracts\QRCodeServiceInterface;
use App\Services\QRCodeService;
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
        $this->app->bind(QRCodeServiceInterface::class, QRCodeService::class);
        $this->app->bind(QRCodeServiceInterface::class, QRCodeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
