<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/cadastro', function () {
    return view('pages.cadastro');
});
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function ($router) {
    Route::get('', ['uses' => 'Auth\AdminController@index',  'as' => 'admin.index']);

    Route::group(['as'=> 'rifa.' ,'prefix'=> 'rifas','middleware' => ['auth:admin'] ], function() {
        Route::get('{name}', ['as'=> 'categoria', 'uses'=> 'RifaController@findCat']);
        Route::get('edit/{id}', ['as'=> 'edit', 'uses'=> 'RifaController@edit']);
        Route::post('update', ['as'=> 'update', 'uses'=> 'RifaController@update']);
        Route::get('items/{id}', ['as'=> 'categoria', 'uses'=> 'RifaController@items']);
        Route::get('items/image/{id}', ['as'=> 'categoria', 'uses'=> 'ItemsController@image']);

    });

    Route::group(['as'=> 'items.' ,'prefix'=> 'items','middleware' => ['auth:admin'] ], function() {

        Route::get('edit/{id}', ['as'=> 'edit', 'uses'=> 'ItemsController@edit']);

        Route::get('image/{id}', ['as'=> 'categoria', 'uses'=> 'ItemsController@image']);
        Route::get('number/{id}', ['as'=> 'categoria', 'uses'=> 'ItemsController@number']);

    });

    Route::group(['as'=> 'transacao.' ,'prefix'=> 'transacao','middleware' => ['auth:admin'] ], function() {
        Route::get('compra', ['as'=> 'compra', 'uses'=> 'TransacaoController@compra']);
        Route::get('', ['as'=> 'index', 'uses'=> 'TransacaoController@index']);
        Route::get('/credit/{id}', ['as'=> 'credit', 'uses'=> 'TransacaoController@credit']);
        Route::get('saque', ['as'=> 'saqueLoja', 'uses'=> 'TransacaoController@saqueAll']);
        Route::post('saque/edit/', ['as'=> 'saqueEdit', 'uses'=> 'TransacaoController@saqueEdit']);
        Route::get('loja', ['as'=> 'loja', 'uses'=> 'TransacaoController@loja']);



    });


    Route::group(['as'=> 'loja.' ,'prefix'=> 'loja','middleware' => ['auth:admin'] ], function() {
        Route::get('', ['as'=> 'index', 'uses'=> 'LojaController@index']);
        Route::get('loja-compra', ['as'=> 'lojacompra', 'uses'=> 'LojaController@lojacompra']);
        Route::get('loja-inventario', ['as'=> 'lojaInvatario', 'uses'=> 'LojaController@lojaInvatario']);
        Route::get('compra-ativar/{id}', ['as'=> 'compraAtivar', 'uses'=> 'LojaController@compraAtivar']);
        Route::get('inventario-ativar/{id}', ['as'=> 'inventarioAtivar', 'uses'=> 'LojaController@inventarioAtivar']);
        Route::get('compra-desativar/{id}', ['as'=> 'compraDesativar', 'uses'=> 'LojaController@compraDesativar']);
        Route::get('inventario-desativar/{id}', ['as'=> 'inventarioDesativar', 'uses'=> 'LojaController@inventarioDesativar']);
        Route::get('compra-editar/{id}', ['as'=> 'compraEditar', 'uses'=> 'LojaController@compraEditar']);
        Route::get('inventario-editar/{id}', ['as'=> 'inventarioEditar', 'uses'=> 'LojaController@inventarioEditar']);
        Route::get('compra-editar/{id}', ['as'=> 'compraEditar', 'uses'=> 'LojaController@compraEditar']);
        Route::post('editar-compra', ['as'=> 'editarCompra', 'uses'=> 'LojaController@editarCompra']);
        Route::post('editar-inventario', ['as'=> 'editarInventario', 'uses'=> 'LojaController@editarInventario']);
        Route::post('salvar-compra', ['as'=> 'salvarCompra', 'uses'=> 'LojaController@salvarCompra']);
        Route::post('salvar-inventario', ['as'=> 'salvarInventario', 'uses'=> 'LojaController@salvarInventario']);
        Route::get('slider-compra', ['as'=> 'sliderCompra', 'uses'=> 'LojaController@sliderCompra']);
        Route::get('slider-compra-create', ['as'=> 'formSliderCompra', 'uses'=> 'LojaController@formSliderCompra']);
        Route::get('slider-compra-delete/{id}', ['as'=> 'deleteSliderCompra', 'uses'=> 'LojaController@deleteSliderCompra']);



    });

    Route::group(['as'=> 'administradores.' ,'prefix'=> 'administradores','middleware' => ['auth:admin'] ], function() {
        Route::get('', ['as'=> 'index', 'uses'=> 'UserController@index']);
        Route::get('create', ['as'=> 'create', 'uses'=> 'UserController@create']);
        Route::post('salvar', ['as'=> 'salvar', 'uses'=> 'UserController@store']);
        Route::post('update', ['as'=> 'update', 'uses'=> 'UserController@udpate']);

        Route::get('edit/{id}', ['as'=> 'edit', 'uses'=> 'UserController@edit']);
        Route::get('imagem/{id}', ['as'=> 'imagem', 'uses'=> 'UserController@imagem']);


    });


    Route::group(['as'=> 'items.' ,'prefix'=> 'items', 'middleware' => ['auth:admin'] ], function() {
        Route::get('home', ['as'=> 'home', 'uses'=> 'ItemsController@index']);
        Route::get('create', ['as'=> 'create', 'uses'=> 'ItemsController@create']);
        Route::get('edit-number/{id}', ['as'=> 'editNumber', 'uses'=> 'ItemsController@editNumber']);
        Route::post('form-number', ['as'=> 'formEditNumber', 'uses'=> 'ItemsController@formEditNumber']);
        Route::get('delete-number/{id}', ['as'=> 'deleteNumber', 'uses'=> 'ItemsController@deleteNumber']);

    });

    Route::group(['as'=> 'usuarios.' ,'prefix'=> 'user', 'middleware' => ['auth:admin'] ], function() {
        Route::get('', ['as'=> 'list', 'uses'=> 'Jogador\JogadorController@admin']);
        Route::get('edit/{id}', ['as'=> 'findUser', 'uses'=> 'Jogador\JogadorController@findUser']);
        Route::post('salvar', ['as'=> 'salvar', 'uses'=> 'Jogador\JogadorController@salverUser']);
        Route::post('credit', ['as'=> 'credit', 'uses'=> 'Jogador\JogadorController@credit']);
        Route::get('transacao/{id}', ['as'=> 'transacao', 'uses'=> 'Jogador\JogadorController@listOrder']);
        Route::get('delete/{id}', ['as'=> 'transacao', 'uses'=> 'Jogador\JogadorController@delete']);


    });

    Route::group(['as'=> 'admin.suporte.' ,'prefix'=> 'suporte', 'middleware' => ['auth:admin'] ], function() {


        Route::get('',  ['as'=> 'index', 'uses'=> 'SuporteController@listHelpDesk']);
        Route::get('resposta/{id}',  ['as'=> 'resposta', 'uses'=> 'SuporteController@resposta']);
//        Route::get('create', ['as'=> 'create', 'uses'=> 'SuporteController@create']);
//        Route::post('salvar', ['as'=> 'salvar', 'uses'=> 'SuporteController@store']);
//        Route::get('suporte-lista', ['as'=> 'lista', 'uses'=> 'SuporteController@lista']);

    });

    $router->group(['namespace' => 'Auth'], function ($router) {


        require app_path('../routes/admin.php');
    });

});
Route::group(['middleware' => ['web']], function ($router) {

    $router->group(['prefix' => 'jogador', 'namespace' => 'Jogador'], function ($router) {
        require app_path('../routes/jogador.php');
    });
//    $router->group(['prefix' => 'admin', 'namespace' => 'Auth'], function ($router) {
//        require app_path('../routes/admin.php');
//    });

});
Route::group(['as'=> 'loja.' ,'prefix'=> 'loja', 'middleware' => ['auth:jogador'] ], function() {
    Route::get('', ['as'=> 'index', 'uses'=> 'LojaController@index']);
    Route::get('loja-compra', ['as'=> 'webLojaCompra', 'uses'=> 'LojaController@webLojaCompra']);
    Route::get('loja-inventario', ['as'=> 'webLojaInventario', 'uses'=> 'LojaController@webLojaInventario']);
    Route::get('loja-compra/credito/{id}', ['as'=> 'compraCredito', 'uses'=> 'LojaController@compraCredito']);
    Route::get('loja-compra/essencia/{id}', ['as'=> 'compraEssencia', 'uses'=> 'LojaController@compraEssencia']);
    Route::get('loja-compra/resgate/{id}', ['as'=> 'compraResgatavel', 'uses'=> 'LojaController@compraResgatavel']);
    Route::get('saque', ['as'=> 'saque', 'uses'=> 'LojaController@saque']);
    Route::post('saque-salvar', ['as'=> 'salverSaque', 'uses'=> 'LojaController@salverSaque']);
});

Route::group(['as'=> 'suporte.' ,'prefix'=> 'suporte', 'middleware' => ['auth:jogador'] ], function() {


    Route::get('',  ['as'=> 'index', 'uses'=> 'SuporteController@index']);
    Route::get('create', ['as'=> 'create', 'uses'=> 'SuporteController@create']);
    Route::post('salvar', ['as'=> 'salvar', 'uses'=> 'SuporteController@store']);
    Route::get('suporte-lista', ['as'=> 'lista', 'uses'=> 'SuporteController@lista']);

});


Auth::routes();

Route::group(['as'=> 'pagseguro.' ,'prefix'=> 'pagseguro', 'middleware' => ['auth:jogador'] ], function() {
    Route::get('', ['as'=> 'index', 'uses'=> 'PagseguroController@index']);
    Route::get('carrinho', ['as'=> 'carrinho', 'uses'=> 'PagseguroController@carrinho']);
    Route::get('checkout', ['as'=> 'carrinho', 'uses'=> 'PagseguroController@checkout']);
    Route::post('salvar/{id}', ['as'=> 'salvar', 'uses'=> 'PagseguroController@salvar']);
    Route::get('remove', ['as'=> 'remove', 'uses'=> 'PagseguroController@remove']);

    Route::post('carrinho-salve', ['as'=> 'salveCarrinho', 'uses'=> 'PagseguroController@salveCarrinho']);
    Route::post('salve-card', ['as'=> 'salveCard', 'uses'=> 'PagseguroController@salveCard']);
    Route::post('finalizar', ['as'=> 'comprafinalizada', 'uses'=> 'PagseguroController@comprafinalizada']);
});


Route::group(['as'=> 'rifa.' ,'prefix'=> 'rifas' ], function() {

    Route::get('', ['as'=> 'index', 'uses'=> 'RifaController@index']);
    Route::get('categoria/{name}', ['as'=> 'categoria', 'uses'=> 'RifaController@categoria']);
    Route::get('historicos', ['as'=> 'historicos', 'uses'=> 'RifaController@historicos']);
    Route::get('{name}/items/{nameItem}', ['as'=> 'show', 'uses'=> 'ItemsController@show']);


});

Route::group(['as'=> 'paypal.' ,'prefix'=> 'paypal' ], function() {

    Route::get('', ['as'=> 'index', 'uses'=> 'PayPalController@index']);
    Route::post('salvar', ['as'=> 'salvar', 'uses'=> 'PayPalController@salvar']);
    Route::get('status',  ['as'=> 'status', 'uses'=> 'PayPalController@getPaymentStatus']);


});




Route::post('notificacao-pagseguro', ['as'=> 'notificacaopagseguro', 'uses'=> 'PagseguroController@notificacaopagseguro']);


Route::get('seller_password/reset', 'Jogador\ForgotPasswordController@showLinkRequestForm');
Route::post('seller_password/email', 'Jogador\ForgotPasswordController@sendResetLinkEmail');
Route::get('seller_password/reset/{token}', 'Jogador\ResetPasswordController@showResetForm');
Route::post('seller_password/reset', 'Jogador\ResetPasswordController@reset');

Route::group(['as'=> 'items.' ,'prefix'=> 'items' ], function() {

    Route::get('', ['as'=> 'index', 'uses'=> 'ItemsController@index']);

    Route::get('{name}', ['as'=> 'show', 'uses'=> 'ItemsController@show']);
    Route::post('/lista/{id}', ['as'=> 'show', 'uses'=> 'ItemsController@listaRifas']);
    Route::post('store', ['as'=> 'store', 'uses'=> 'ItemsController@store']);

});

Route::get('/home', 'HomeController@index')->name('home');
