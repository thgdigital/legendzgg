<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 19/09/2018
 * Time: 14:01
 */


$router->get('login', [
    'uses' => 'AdminController@login',
    'as' => 'admin.login',
]);

$router->get('dashboard', [
    'uses' => 'AdminController@index',
    'as' => 'index',
    'middleware' => ['auth:admin']
]);


$router->get('sair', [
    'uses' => 'AdminController@logout',
    'as' => 'logout',
]);
$router->post('send-login', [
    'uses' => 'AdminController@sendLogin',
    'as' => 'sendLogin',
]);