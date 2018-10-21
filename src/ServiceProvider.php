<?php

namespace kofoworola\Subdomains;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register(){
        $this->app->singleton(Subdomains::class,function ($app){
           return new Subdomains();
        });
    }

    public function boot(){
        $config_path = __DIR__."/../config/subdomains.php";
        $this->publishes([$config_path => config_path('subdomains.php')]);
    }
}