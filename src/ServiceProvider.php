<?php

namespace kofoworola\Subdomains;


use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton(Subdomains::class, function ($app) {
            $name = config('subdomains.subdomain');
            $value = $app->make(Request::class)->route($name);
            return new Subdomains($name,$value);
        });
    }

    public function boot()
    {
        $config_path = __DIR__ . "/../config/subdomains.php";
        $this->publishes([$config_path => config_path('subdomains.php')]);
    }
}