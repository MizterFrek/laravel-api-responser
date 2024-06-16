<?php

namespace MizterFrek\LaravelApiResponser\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use MizterFrek\LaravelApiResponser\Providers\ApiResponseServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ApiResponseServiceProvider::class
        ]; 
    }

    protected function getPackageAliases($app)
    {
        return[
            'ApiResponse' => \MizterFrek\LaravelApiResponser\Facades\ApiResponse::class
        ];
    }
}