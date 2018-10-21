<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/21/18
 * Time: 5:22 PM
 */

namespace kofoworola\Subdomains;


class Subdomains
{
    public function parameter(){
        return config('subdomains.subdomain');
    }
}