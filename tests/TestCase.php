<?php
namespace kofoworola\Subdomains\Tests;

use kofoworola\Subdomains\Facade\Subdomains;
use kofoworola\Subdomains\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return ServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Subdomains' => Subdomains::class,
        ];
    }
}