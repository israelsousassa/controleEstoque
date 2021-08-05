<?php

namespace App\Http\Controllers;

use App\Produto;
use Request;
use App\Http\Requests\ProdutosRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['adiciona', 'remove']]);
    }
    public function lista()
    {
        $produtos = Produto::all();

        return view('produto.listagem')->with('produtos',$produtos);
    }

    public function mostra($id)
    {
        
        $produto = Produto::find($id);
        
        if(empty($produto)){
            return "Esse produto não existe";
        }

        return view('produto.detalhes')->with('p', $produto);

    }

    public function novo()
    {
        return view('produto.formulario');
    }

    public function adiciona(ProdutosRequest $request)
    {   
       
        Produto::create($request->all());

        return redirect()->action('ProdutoController@lista')
        ->withInput(Request::only('nome'));
        
    }

    public function listaJson()
    {
        $produto = Produto::all();
        return response()->json($produto);
    }

    public function remove($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->action('ProdutoController@lista');
    }
    
    public function altera($id)
    {
        $produto = Produto::find($id);
        return view('produto.alterado')->with('p',$produto);
    }
    
    public function update()
    {   
        $id=53;
        $nome = 'Motorola G8';
        $valor = 1300;
        $decricao = 'Branco neve';
        $quantidade = 20;
        
            DB::table('produtos')
                ->where('id', $id)
                ->update([
                    'nome' => $nome,
                    'valor' => $valor,
                    'descricao' => $decricao,
                    'quantidade' => $quantidade
                ]);

        /*
        DB::update('UPDATE produtos SET nome = ?, valor = ?, 
        descricao = ?, quantidade = ? WHERE id = ?', 
        array($nome, $valor, $decricao, $quantidade, $produto));
        */
        return view('produto.listagem');
    }

   
    
}