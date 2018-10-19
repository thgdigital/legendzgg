<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['as'=> 'rifa.' ,'prefix'=> 'rifas' ], function() {

    Route::get('{name}', ['as'=> 'listAll', 'uses'=> 'RifaController@listAll']);
    Route::post('salved', ['as'=> 'salvar', 'uses'=> 'RifaController@store']);
    Route::get('list-rifas/{id}', ['as'=> 'rifas', 'uses'=> 'RifaController@findRifas']);
    Route::get('items/{id}', ['as'=> 'find', 'uses'=> 'ItemsController@find']);
    Route::post('salvar', ['as'=> 'find', 'uses'=> 'ItemsController@salvar']);
    Route::post('items/update-image/{id}', ['as'=> 'updateImage', 'uses'=> 'ItemsController@updateImage']);


});

Route::group(['as'=> 'transacao.' ,'prefix'=> 'transacao' ], function() {
    Route::get('', ['as'=> 'fidAll', 'uses'=> 'TransacaoController@fidAll']);
    Route::post('salve-credito', ['as'=> 'salveCredit', 'uses'=> 'TransacaoController@salveCredit']);


});
Route::group(['as'=> 'pagseguro.' ,'prefix'=> 'pagseguro'], function() {

    Route::post('salvar', ['as' => 'store', 'uses' => 'PagseguroController@store']);
});


Route::group(['as'=> 'user.' ,'prefix'=> 'user' ], function() {
    Route::get('', ['as'=> 'listAll', 'uses'=> 'JogadorController@listAll']);
    Route::post('update-imagem/{id}', ['as'=> 'updateImagem', 'uses'=> 'UserController@updateImagem']);


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
