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
        $this->middleware('auth',['only' => [
            'lista',
            'adiciona', 
            'remove',
            'altera',
            'mostra',
            'fornecedor',
            'listaJson'
            ]
        ]);
    }
    public function lista()
    {
        $produtos = Produto::all();
        return view('produto.listagem')->with('produtos',$produtos);
    }
    public function listaEntrada()
    {
        $produtos = Produto::all();
        return view('produto.entrada')->with('produtos',$produtos);
    }
    

    public function mostra($id)
    {
        $produto = Produto::find($id);
        
        return view('produto.detalhes')->with('p', $produto);

    }

    public function entradaProduto(ProdutosRequest $request)
    {   
            $qtdeun = $request->input('qtdeun');
            $code = $request->input('code');
            $codecx =  DB::select('SELECT codebarracx FROM tb_produtos WHERE codebarracx=?',[$code]);
            $sql = DB::select('SELECT * FROM tb_produtos WHERE codebarra =? OR codebarracx=?',[$code,$code]);
            $decode = json_decode(json_encode($sql),true);
            if(empty($sql)){
                return view('produto.vazio');
            }else{  
                    if($qtdeun <= 0){
                        return view("produto.erro");
                    }           
                    elseif(empty($codecx)){ 
                        $sum = $qtdeun + $decode[0]['qtdeun'];
                        $div = $sum / $decode[0]['uncaixa'];
                        $x = (int) $div;
                        DB::update('UPDATE tb_produtos SET qtdeun =?, qtdecx=? WHERE codebarra=?',[$sum,$x,$code]);

                    }else{
                        $qtde = $decode[0]['qtdecx'] + $qtdeun;
                        $result = $decode[0]['qtdeun'] + ($decode[0]['uncaixa'] * $qtdeun);
                        DB::update('UPDATE tb_produtos SET qtdeun=?, qtdecx =? WHERE codebarracx=?',[$result,$qtde,$code]);
                    }
                    
                    return redirect()->action('ProdutoController@listaEntrada')->withInput(Request::only('qtdeun','code'));
            }    
    }
       
    public function listaSaida()
    {
        return view('produto.saida');
    }

    public function saidaProduto(ProdutosRequest $request)
    {
        $qtdeun = $request->input('qtdeun');
        $code = $request->input('code');
        $sql = DB::select('SELECT * FROM tb_produtos WHERE codebarra =? OR codebarracx=?',[$code,$code]);
        $decode = json_decode(json_encode($sql),true);
        $dbcodecx = $decode[0]['codebarracx'];
        $dbqtdeun = $decode[0]['qtdeun'];
        $dbuncx = $decode[0]['uncaixa'];
        $dbqtdecx = $decode[0]['qtdecx'];

        if(empty($sql)){
            return view('produto.vazio');
        }else{
            $sub = $dbqtdeun - $qtdeun;
            $mult = $dbuncx * $dbqtdecx;
            $x = $dbuncx * $qtdeun;

            if($qtdeun <= 0){
                return view("produto.erro");
            }elseif(empty($dbqtdeun) || $qtdeun > $dbqtdeun){
                return view('produto.empty');
            }elseif($code != $dbcodecx || empty($dbcodecx)){
                $w = $sub / $dbuncx;
                $y = (int) $w;
                DB::update('UPDATE tb_produtos SET qtdeun =?, qtdecx=? WHERE codebarra=?',[$sub,$y,$code]);
            }else{
                if($x > $dbqtdeun){
                    return view('produto.empty');
                }elseif($qtdeun > $dbqtdecx){
                    $qtde = $qtdeun - $dbqtdecx;
                }else{
                    $qtde = $dbqtdecx - $qtdeun;
                }
                $result = $dbqtdeun - $x;
                DB::update('UPDATE tb_produtos SET qtdeun=?, qtdecx =? WHERE codebarracx=?',[$result,$qtde,$code]);
            }
           
            return redirect()->action('ProdutoController@listaSaida')
            ->withInput(Request::only('qtdeun','code'));
        }

    }

    public function registra()
    {
        return view('produto.cadastro');
    }

    public function fornecedor()
    {
        return view('produto.listafornecedor');
    }

    public function adicionaFornecedor(ProdutosRequest $request) 
    {
        $fornecedor = $request->input('fornecedor');
        $telefone = $request->input('telefone');
        $email = $request->input('email');
        $endereco = $request->input('endereco');

        DB::insert('INSERT INTO tb_fornecedor(
            nome,telefone,email,endereco
            )value(?,?,?,?)',[
                $fornecedor,$telefone,$email,$endereco
            ]);

            return redirect()->action('ProdutoController@registra');
        /*->withInput(Request::only('nome','marca', 'medida'));*/
    }

    public function adiciona(ProdutosRequest $request)
    {   
        $fornecedor = $request->input('fornecedor');
        if($fornecedor == "Selecione o fornecedor"){
            $fornecedor = " ";
        }
        $nome = $request->input('nome');
        $marca = $request->input('marca');
        $medida = $request->input('medida');
        $descricao = $request->input('descricao');
        $valcusto = $request->input('valcusto');
        $uncaixa = $request->input('uncaixa');
        $codebarra = $request->input('codebarra');
        $codebarracx = $request->input('codebarracx');

        $sql = DB::select('SELECT id_fornecedor FROM tb_fornecedor WHERE nome = ?',[$fornecedor]);
        $decode = json_decode(json_encode($sql),true);
        if(empty($sql)){
            $fornecedor = null;
        }else{
            $fornecedor = $decode[0]['id_fornecedor'];
        }
        
        $select = DB::select('SELECT codebarra,codebarracx FROM tb_produtos');
        $deco = json_decode(json_encode($select),true);
        
        if(empty($select)){
            if($codebarra == $codebarracx){
                return view('produto.code');
            }
            DB::insert('INSERT INTO tb_produtos(
            nome, marca, medida, descricao, valcusto, uncaixa, codebarra, codebarracx, fornecedor
            ) values(?,?,?,?,?,?,?,?,?)',[
            $nome, $marca, $medida, $descricao, $valcusto, $uncaixa, $codebarra, $codebarracx,$fornecedor
            ]);
        }else{
            $codeun = $deco[0]['codebarra'];
            $codecx = $deco[0]['codebarracx'];

            if($codeun == $codebarra || $codecx == $codebarracx || 
                $codecx == $codebarra || $codeun == $codebarracx ||
                $codebarra == $codebarracx){
                return view('produto.code');
            }
            DB::insert('INSERT INTO tb_produtos(
            nome, marca, medida, descricao, valcusto, uncaixa, codebarra, codebarracx, fornecedor
            ) values(?,?,?,?,?,?,?,?,?)',[
            $nome, $marca, $medida, $descricao, $valcusto, $uncaixa, $codebarra, $codebarracx,$fornecedor
            ]);
        } 
        return redirect()->action('ProdutoController@registra')
        ->withInput(Request::only('nome','marca', 'medida'));
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

    public function update(ProdutosRequest $request) {
        $id = $request->input('id');
        $produto = $request->input('nome');
        $marca = $request->input('marca');
        $medida = $request->input('medida');
        $sql = DB::select('SELECT * FROM tb_produtos WHERE id = ?',[$id]);
        
        if (!empty($sql)) {

            DB::update('UPDATE tb_produtos 
                        SET nome = ?, 
                        marca = ?, 
                        medida = ? 
                        WHERE id = ?',
                        [$produto,$marca,$medida,$id]);
                        
                        return view('produto.atualizado');
                        
            
        }
    }

     public function sair()
    {
        return view('Auth.login');
    }
    
    
    
}