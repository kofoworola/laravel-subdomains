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

    private $value;

    /**
     * Get name of parameter
     * @return \Illuminate\Config\Repository|mixed
     */
    public function parameterName(){
        return config('subdomains.subdomain');
    }

    /**
     * Set the value of the subdomain called
     * @param $value
     */
    public function setValue($value){
        $this->value = $value;
    }

    /**
     * Get value of subdomain being called
     * @return mixed
     */
    public function parameterValue(){
        return $this->value;
    }
}