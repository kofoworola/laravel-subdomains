<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/22/18
 * Time: 12:14 AM
 */

namespace kofoworola\Subdomains\Middleware;


use Closure;
use kofoworola\Subdomains\Facade\Subdomains;

class HasSubdomain
{
    public function handle($request, Closure $next){
        if(!Subdomains::owner()){
            abort(404);
        }
        if(!Subdomains::ownsModel()){
            abort(401);
        }
        return $next($request);
    }
}