<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/21/18
 * Time: 5:22 PM
 */

namespace kofoworola\Subdomains;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Subdomains
{

    private $name;
    private $value;
    private $owner;

    public function __construct($name,$value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get name of parameter
     * @return \Illuminate\Config\Repository|mixed
     */
    public function name(){
        return $this->name;
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
    public function value(){
        return $this->value;
    }

    /**
     * Get owner model of current subdomain
     * @return mixed
     */
    public function owner(){
        if(!$this->owner){
            $owner = config('subdomains.model');
            $column = config('subdomains.column');
            $this->owner = $owner::where($column,$this->value)->first();
        }
        return $this->owner;
    }

    /**
     * Checks if the user owns the current model
     * @param null $user
     * @return bool
     */
    public function ownsModel($user = null){
        $user = $user ?? Auth::user();
        $function = config('subdomains.middleware')['function'];
        $owner = $this->owner();

        $models = $user->$function ?? $user->$function();
        if($models instanceof Collection || is_array($models)){
            $models = collect($models);
            $filtered = $models->filter(function ($value,$key) use ($owner){
               return $value->getKey() == $owner->getKey();
            });
            if($filtered->count() < 1)
                return false;
            else
                return true;
        }
        elseif (!is_null($models)){
            return $models->getKey() == $owner->getKey();
        }
        return false;
    }

    public function route($route,$param = [],$model= null){
        $model = $model ?? $this->owner();
        if(is_null($model))
        {
            abort("505","The model instance could not be found");
            return;
        }

        $name = $this->name();
        $column = config('subdomains.column');
        $data[$name] = $model->$column;
        $data = array_merge($data, $param);
        return route($route,$data);
    }
}