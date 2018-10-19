<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 16/10/2018
 * Time: 22:04
 */

return [
    "client_id" => env("PAYPAL_CLIENT", ""),
    "secret" => env("PAYPAL_SECRET", ""),
    "settings" => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];