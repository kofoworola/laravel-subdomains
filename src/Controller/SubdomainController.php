<?php

namespace kofoworola\Subdomains\Controller;


use Illuminate\Routing\Controller;
use kofoworola\Subdomains\Facade\Subdomains;

class SubdomainController extends Controller
{
    public function callAction($method, $parameters)
    {
        $name = Subdomains::parameterName();
        unset($parameters[$name]);
        return parent::callAction($method, $parameters);
    }
}