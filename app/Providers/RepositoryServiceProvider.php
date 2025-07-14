<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Interface\TypeFormInterface;
use App\Interface\ResponseTypeFormInterface;
use App\Repository\TypeFormRepository;
use App\Repository\ResponseTypeFormRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
            $this->app->bind(TypeFormInterface::class, TypeFormRepository::class);
            $this->app->bind(ResponseTypeFormInterface::class, ResponseTypeFormRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
