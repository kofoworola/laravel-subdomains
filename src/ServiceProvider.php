<?php

namespace kofoworola\Subdomains;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(){
        $this->app->singleton(Subdomains::class,function ($app){
           return new Subdomains();
        });
    }

    public function boot(){
        $config_path = __DIR__."/../config/subdomains.php";
        $this->mergeConfigFrom($config_path,'subdomains');
    }
}