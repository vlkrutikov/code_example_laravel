<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class ValidatorServiceProvider
 * @package App\Providers
 */
class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Validator::extend('olderThan', static function ($attribute, $value, $parameters) {
            $minAge = (!empty($parameters)) ? (int)$parameters[0] : 18;

            return (new \DateTime())->diff(new \DateTime($value))->y >= $minAge;
        });
    }
}
