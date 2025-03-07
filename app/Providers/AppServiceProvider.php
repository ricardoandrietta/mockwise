<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MockWise\Domain\UserSchema\UserSchemaRepositoryInterface;
use MockWise\Infrastructure\Persistence\Eloquent\UserSchema\UserSchemaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserSchemaRepositoryInterface::class, UserSchemaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
