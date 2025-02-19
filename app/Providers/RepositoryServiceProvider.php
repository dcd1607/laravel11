<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Wine\WineRepositoryInterface;
use App\Repositories\Wine\EloquentWineRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );

        $this->app->bind(
            WineRepositoryInterface::class,
            EloquentWineRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
