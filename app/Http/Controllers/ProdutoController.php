<?php

namespace App\Http\Controllers;
use App\Produto;
use App\Entrada;
use App\Saida;
use App\Fornecedor;
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
        if(view()->exists('produto.listagem')) {
            return view('produto.listagem')->with('produtos', Produto::all());
        }
    }

    public function listaEntrada()
    {
        if(view()->exists('produto.entrada')) {
            return view('produto.entrada');
        }
        
    }

    public function mostra($id)
    {
        if(view()->exists('produto.detalhes')) {
            return view('produto.detalhes')->with('p', Produto::find($id));
        }

    }

    public function entradaProduto(ProdutosRequest $request)
    {   
            $qtdeun = $request->qtdeun;
            $code =  $request->code;
            $codecx = Produto::where('codebarracx',$code)
                               ->value('codebarracx');

            $produto = DB::select(
                'SELECT * FROM tb_produtos 
                          WHERE codebarra = ? 
                             OR codebarracx = ?',[
                                $code,$code
                            ]);

            if(empty($produto)) {
                return view('produto.vazio');
            }else{

                if($qtdeun <= 0) {
                    return view('produto.vazio');
                }elseif(empty($codecx)){
                    $sum = $qtdeun + $produto[0]->qtdeun;
                    $div = $sum / $produto[0]->uncaixa;
                    $int = (int) $div;

                    DB::update('UPDATE tb_produtos 
                                   SET qtdeun = ?, qtdecx = ? 
                                   WHERE codebarra = ?',[
                                    $sum,$int,$code
                                ]);

                    $e = new Entrada();
                    $e->nome = $produto[0]->nome;
                    $e->marca = $produto[0]->marca;
                    $e->medida = $produto[0]->medida;
                    $e->qtde = $qtdeun;
                    $e->save();

                    $out = [
                        'nome' => $produto[0]->nome,
                        'marca' => $produto[0]->marca,
                        'medida' => $produto[0]->medida,
                        'qtdeun' => $qtdeun,
                        'unorcx' => 'unidade(s)'
                    ];

                    return view('produto.entrada')->with('produto',$out);

                }else{
                    $mult = $produto[0]->uncaixa * $qtdeun;
                    $qtde = $produto[0]->qtdecx + $qtdeun;
                    $result = $produto[0]->qtdeun + $mult;

                    DB::update('UPDATE tb_produtos 
                            SET qtdeun = ?, qtdecx = ? 
                            WHERE codebarracx = ?',[
                                $result,$qtde,$code
                            ]);

                    $e = new Entrada();
                    $e->nome = $produto[0]->nome;
                    $e->marca = $produto[0]->marca;
                    $e->medida = $produto[0]->medida;
                    $e->qtde = $mult;
                    $e->save();

                    $out = [
                        'nome' => $produto[0]->nome,
                        'marca' => $produto[0]->marca,
                        'medida' => $produto[0]->medida,
                        'qtdeun' => $qtdeun,
                        'mult' => $mult,
                        'unorcx' => 'caixa(s)'
                    ];

                    return view('produto.entrada')->with('produto',$out);
                }
            }       
    }
       
    public function listaSaida()
    {
        return view('produto.saida');
    }

    public function saidaProduto(ProdutosRequest $request)
    {
        $qtdeun = $request->qtdeun;
        $code = $request->code;
        $produto = DB::select(
            'SELECT * FROM tb_produtos 
                      WHERE codebarra =? 
                      OR codebarracx=?',[
                          $code,$code
                        ]);

        if(empty($produto)){
            return view('produto.vazio');
        }else{
            $dbcodecx = $produto[0]->codebarracx;
            $dbqtdeun = $produto[0]->qtdeun;
            $dbuncx = $produto[0]->uncaixa;
            $dbqtdecx = $produto[0]->qtdecx;
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

                DB::update('UPDATE tb_produtos 
                               SET qtdeun =?, qtdecx=? 
                               WHERE codebarra=?',[
                                   $sub,$y,$code
                                ]);

                $e = new Saida();
                $e->nome = $produto[0]->nome;
                $e->marca = $produto[0]->marca;
                $e->medida = $produto[0]->medida;
                $e->qtde = $qtdeun;
                $e->save();

                $out = [
                        'nome' => $produto[0]->nome,
                        'marca' => $produto[0]->marca,
                        'medida' => $produto[0]->medida,
                        'qtdeun' => $qtdeun,
                        'unorcx' => 'unidade(s)'
                    ];

                    return view('produto.saida')->with('produto',$out);
                
            }else{
                if($x > $dbqtdeun){
                    return view('produto.empty');
                }elseif($qtdeun > $dbqtdecx){
                    $qtde = $qtdeun - $dbqtdecx;
                }else{
                    $qtde = $dbqtdecx - $qtdeun;
                }
                $result = $dbqtdeun - $x;
                
                DB::update('UPDATE tb_produtos 
                               SET qtdeun=?, qtdecx =? 
                             WHERE codebarracx=?',[
                                 $result,$qtde,$code
                                ]);
                $e = new Entrada();
                $e->nome = $produto[0]->nome;
                $e->marca = $produto[0]->marca;
                $e->medida = $produto[0]->medida;
                $e->qtde = $mult;
                $e->save();

                $out = [
                    'nome' => $produto[0]->nome,
                    'marca' => $produto[0]->marca,
                    'medida' => $produto[0]->medida,
                    'qtdeun' => $qtdeun,
                    'mult' => $mult,
                    'unorcx' => 'caixa(s)'
                ];

                    return view('produto.saida')->with('produto',$out);

            }
           
        }

    }

    public function registra()
    {   
        if(view()->exists('produto.cadastro')) {
            return view('produto.cadastro')->with('fornecedor', Fornecedor::all());
        }
    }

    public function adiciona(ProdutosRequest $request)
    {   

        if($request->fornecedor == "Selecione o fornecedor"){
            $fornecedor = NULL;
        }else{
            $id = Fornecedor::where('nome',$request->fornecedor)->value('id');
            $fornecedor = $id;
        }
        
        $produto = DB::select('SELECT codebarra, codebarracx FROM tb_produtos'); 


            if($request->codebarra == $request->codebarracx) {

                return view('produto.code');

            }elseif(!empty($produto)) {
                    
                    $codeun = $produto[0]->codebarra;
                    $codecx = $produto[0]->codebarracx;
                        
                    if($codeun == $request->codebarra || $codecx == $request->codebarracx || 
                        $codecx == $request->codebarra || $codeun == $request->codebarracx)
                    {        
                        return view('produto.code');
                    }
            }
            
        $p = new Produto();
        $p->nome = $request->nome;
        $p->marca = $request->marca;
        $p->medida = $request->medida;
        $p->descricao = $request->descricao;
        $p->valcusto = $request->valcusto;
        $p->uncaixa = $request->uncaixa;
        $p->codebarra = $request->codebarra;
        $p->codebarracx = $request->codebarracx;
        $p->fornecedor = $fornecedor;
        $p->save();
        
        return redirect()->action('ProdutoController@registra')
                         ->withInput(Request::only('nome','marca', 'medida'));

    }

    public function remove($id)
    {
        Produto::find($id)->delete();
        return redirect()->action('ProdutoController@lista');
    }
    
    public function altera($id)
    {
        if(view()->exists('produto.alterado')){
            return view('produto.alterado')->with('p', Produto::find($id));
        }
    }

    public function update(ProdutosRequest $request, $id) 
    {
        $produtos = Produto::find($id);
        if(!empty($produtos)){
            $produtos->fill($request->input())->save();
            return view('produto.atualizado');
        }
    }

    public function sair()
    {
        return view('Auth.login');
    }
    
    
    
}