<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entrada;
Use App\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    public function listaInput()
    {
        $select = DB::select('SELECT distinct nome,marca, medida 
                                         FROM tb_entrada');
        if(!empty($select)) {

            $entrada = DB::select('SELECT nome,medida,marca, 
                                count(marca) as num_estoque, 
                                sum(qtde) as qtde_produto 
                                from tb_entrada 
                                group by nome,medida,marca 
                                order by qtde_produto 
                                desc',[
                                    $select[0]->nome, $select[0]->marca
                                ]);
            
            if(view()->exists('entrada.input')) {
                return view('entrada.input')->with('entrada',$entrada);
            }
        }else{
            return view('entrada.empty');
        }
    }
}
