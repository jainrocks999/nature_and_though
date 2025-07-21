<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Interface\TypeFormInterface;
use App\Interface\ResponseTypeFormInterface;
use App\Interface\SurveyConfigInterface;
use App\Interface\UserInterface;
use App\Interface\ProductInterface;

use App\Repository\TypeFormRepository;
use App\Repository\ResponseTypeFormRepository;
use App\Repository\SurveyConfigRepository;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
            $this->app->bind(TypeFormInterface::class, TypeFormRepository::class);
            $this->app->bind(ResponseTypeFormInterface::class, ResponseTypeFormRepository::class);
            $this->app->bind(SurveyConfigInterface::class, SurveyConfigRepository::class);
            $this->app->bind(UserInterface::class, UserRepository::class);
            $this->app->bind(ProductInterface::class, ProductRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
