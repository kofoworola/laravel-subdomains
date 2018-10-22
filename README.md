# Associate models to dynamic subdomains in laravel

Easily setup dynamic subdomains registered to models on your application
e.g `company1.myapp.com`

* [Intallation](#installation)
* [Config](#config)
* [Usage](#usage)
* [Facade](#facade)
* [Middleware](#middleware)

## <a name="installation"></a> Installation
You can install this package via composer by
 
```composer require kofoworola/laravel-subdomain ```

*In Laravel 5.5 and below add this to your providers and aliases array
```
'providers'=>[
    //...
    kofoworola\Subdomains\ServiceProvider::class
]
```

```
'aliases' => [
    //..
    'Subdomains': kofoworola\Subdomains\Facade\Subdomains::class
] 
```

Then run `php artisan vendor:publish` to publish the configuration file

## <a name="config"></a> Config
The `config/subdomains.php` file:
```$xslt
<?php
return [
    /*
     * The name of the parameter to be used for subdomains
     */
    'subdomain' => 'app',

    /*
     * The model that owns subdomains
     */
    'model' => '\App\Company',

    /*
     * The column in the user
     */
    'column' => 'slug',

    'middleware' => [

        /*
         * The user model to perform authentication checking on
         */
        'user_model' => '\App\User',

        /*
         * The function/relationship that defines the link between the user model and the subdomain owner 
         * Can return Collection/Array of Models or single model
         */
        'function' => 'companies',
    ]
];
```
Once you have published the package, you can then set the configuration to your application's setup

## <a name="usage"></a> Usage
After setting up your routes to catch subdomains e.g
```$xslt
Route::group(['domain' => '{app}.subdomains.app','middleware' => ['auth']],function (){
    Route::get('/','SubController@index')->name('index');
    Route::get('/{param}',SubController@param)->name('param')
    //Rest of routes
});
```
Make sure all controller assigned to subdomains extend the `\kofoworola\Subdomains\Controller\SubdomainController` class:
```$xslt
use kofoworola\Subdomains\Controller\SubdomainController;

class SubController extends SubdomainController
{
    public function index(){
        return 'hello';
    }

    /*
     * No need to get the subdomain value via parameter for every method redundantly
     * You can get it through the subdomain facade when needed
     */ 
    public function param($param){
        return $param;
    }
}

```
The parent controller automatically removes the subdomain parameter from list of paremeters
so you don't have to add it to you parameter list everytime you want to get another parameter

## <a name="facade"></a>Facade
Using the `kofoworola\Subdomains\Facade\Subdomains` facade you can access helper functions:

### Getting the name of the parameter
Use `Subdomains::name()` to get the name of the subdomain parameter

### Getting the value of the subdomain
Use `Subdomains::value()` to get the value of the subdomain parameter

### Getting the owner of the subdomain
Use `Subdomains::owner()` to get the model instance that owns the current subdomain

### Checking if the user has access to the subdomain
`Subdomains::ownsModel($user = null)` returns true or false depending on whether the user has access to the subdomain

If no user is passed the current logged in user is used

###  Getting a subdomain route
```$xslt
//If model is passed the value of its subdomain will be used to generate route
//If not the current owner will be used

Subdomains::route('route.name',$params = [],$model = null);
```
Can be used to generate a subdomain link 

## <a name="middleware"></a> Middleware
You can also add the `\kofoworola\Subdomains\Middleware\HasSubdomain` middleware to your routes.
Firstly register it in your `Kernel`:
```$xslt
protected $routeMiddleware = [
        //Rest of middlewares
        'subdomain' => \kofoworola\Subdomains\Middleware\HasSubdomain::class,
    ];
```
Then add it to your routes:
```$xslt
Route::group(['domain' => '{app}.subdomains.app','middleware' => ['auth','subdomains']],function (){
    //Rest of routes
});
```

The middleware will take care of verifying if:
* The subdomain exists 
* The current user has access to the subdomain 
 
