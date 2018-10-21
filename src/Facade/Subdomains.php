<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/21/18
 * Time: 5:59 PM
 */

namespace kofoworola\Subdomains\Facade;


use Illuminate\Support\Facades\Facade;

class Subdomains extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \kofoworola\Subdomains\Subdomains::class;
    }
}