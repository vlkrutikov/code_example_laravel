<?php

namespace App\Providers;

use App\Actions\CreateUser;
use App\Contracts\Actions\CreateUserInterface;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(CreateUserInterface::class, CreateUser::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
