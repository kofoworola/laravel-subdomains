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