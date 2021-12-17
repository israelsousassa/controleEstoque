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
->where('id', '[0-9]+');

Route::post('/produtos/inseri','ProdutoController@entradaProduto');

Route::get('/produtos/entrada','ProdutoController@listaEntrada');

Route::post('/produtos/remover','ProdutoController@saidaProduto');

Route::get('/produtos/cadastro','ProdutoController@registra');

Route::post('/produtos/adiciona','ProdutoController@adiciona');

Route::get('/produtos/saida','ProdutoController@listaSaida');

Route::get('/produtos/remove/{id}','ProdutoController@remove')
->where('id', '[0-9]+');

Route::get('/produtos/altera/{id}','ProdutoController@altera')
->where('id', '[0-9]+');

Route::post('/produtos/update','ProdutoController@update');

Route::get('/','ProdutoController@sair');

Route::get('/produto/lista/entrada', 'EntradaController@listaInput');
Route::get('/produto/lista/saida', 'SaidaController@listaOut');

Route::get('/produtos/fornecedor','FornecedorController@fornecedor');
Route::post('/produtos/adiciona/fornecedor','FornecedorController@addFornecedor');


