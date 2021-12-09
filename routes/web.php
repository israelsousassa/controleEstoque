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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produtos','ProdutoController@lista');

Route::get('/produtos/mostra/{id}','ProdutoController@mostra')
-> where('id', '[0-9]+');

//Route::get('/produtos/novo','ProdutoController@novo');

Route::post('/produtos/inseri','ProdutoController@entradaProduto');

Route::get('/produtos/entrada','ProdutoController@listaEntrada');

Route::post('/produtos/remover','ProdutoController@saidaProduto');

Route::get('/produtos/cadastro','ProdutoController@registra');

Route::post('/produtos/adiciona','ProdutoController@adiciona');

Route::get('/produtos/saida','ProdutoController@listaSaida');

Route::post('/produtos/adiciona/fornecedor','ProdutoController@adicionaFornecedor');

Route::get('/produtos/json','ProdutoController@listaJson');

Route::get('/produtos/remove/{id_produto}','ProdutoController@remove');

Route::get('/produtos/altera/{id_produto}','ProdutoController@altera');

Route::post('/produtos/update','ProdutoController@update');

Route::get('/produtos/fornecedor','ProdutoController@fornecedor');

Route::get('/','ProdutoController@sair');

Route::get('/code', function(){


});


