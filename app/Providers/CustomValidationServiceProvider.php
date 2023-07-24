<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
    public function boot()
    {
        Validator::extend('decimal', function ($attribute, $value, $parameters, $validator) {
            return is_numeric($value) && strpos((string) $value, '.') !== false;
        });
    }
}
