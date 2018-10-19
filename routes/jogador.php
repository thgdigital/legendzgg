<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 08/07/2018
 * Time: 13:29
 */

Route::group(['middleware' => 'jogador'], function ($router) {
    $router->get('/', [
        'uses' => 'JogadorController@index',
        'as' => 'jogador.index',
    ]);
});
$router->group(['middleware' => ['auth:jogador']], function ($router) {
    $router->get('/', [
        'uses' => 'JogadorController@index',
        'as' => 'jogador.index',
    ]);
});
$router->get('entrar', [
    'uses' => 'AuthController@index',
    'as' => 'jogador.auth.index',
]);

$router->get('endereco', [
    'uses' => 'JogadorController@endereco',
    'as' => 'jogador.create',
]);
$router->get('cadastrar-credit', [
    'uses' => 'JogadorController@creditCard',
    'as' => 'jogador.creditCard',
]);
$router->get('listar-cartao', [
    'uses' => 'JogadorController@listarCartao',
    'as' => 'jogador.listarCartao',
]);
$router->get('edit-cartao/{id}', [
    'uses' => 'JogadorController@editCard',
    'as' => 'jogador.editCard',
]);


$router->post('endereco-salvar', [
    'uses' => 'JogadorController@salveEndereco',
    'as' => 'jogador.salveEndereco',
]);
$router->post('atualizar-card', [
    'uses' => 'JogadorController@storeCard',
    'as' => 'jogador.storeCard',
]);


$router->post('', [
    'uses' => 'AuthController@login',
    'as' => 'jogador.auth.login',
]);
$router->post('salve-credit-card', [
    'uses' => 'JogadorController@saveCreditCard',
    'as' => 'jogador.saveCreditCard',
]);

$router->get('edit', [
    'uses' => 'JogadorController@edit',
    'as' => 'jogador.edit',
]);
$router->post('cadastro-create', [
    'uses' => 'JogadorController@criarConta',
    'as' => 'jogador.create',
]);
$router->get('verify/{token}', [
    'uses' => 'JogadorController@verifyUser',
    'as' => 'jogador.verify',
]);

$router->post('salvar', [
    'uses' => 'JogadorController@store',
    'as' => 'jogador.salvar',
]);
$router->get('login', [
    'uses' => 'JogadorController@login',
    'as' => 'jogador.login',
]);
$router->get('reset', [
    'uses' => 'JogadorController@reset',
    'as' => 'jogador.reset',
]);

$router->get('email', [
    'uses' => 'JogadorController@email',
    'as' => 'jogador.email',
]);
$router->get('sair', [
    'uses' => 'AuthController@logout',
    'as' => 'jogador.auth.logout',
]);

$router->get('recompensa', [
    'uses' => 'JogadorController@recompensa',
    'as' => 'jogador.recompensa',
    'middleware' => ['auth:jogador']
]);