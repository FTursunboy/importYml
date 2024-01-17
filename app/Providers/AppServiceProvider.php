<?php

namespace App\Providers;

use App\Services\Contracts\ImportDbInterface;
use App\Services\Contracts\ImportExcelInterface;
use App\Services\ConvertToExcelService;
use App\Services\ImportToDb;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImportExcelInterface::class, ConvertToExcelService::class);
        $this->app->singleton(ImportDbInterface::class, ImportToDb::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
