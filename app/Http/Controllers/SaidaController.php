<?php

namespace App\Http\Controllers;
use App\Saida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaidaController extends Controller
{
    public function listaOut()
    {   
            $saida = DB::select('SELECT nome,medida,marca, 
                                count(marca) as num_venda, 
                                sum(qtde) as qtde_venda 
                                from tb_saida 
                                group by nome,medida,marca 
                                order by qtde_venda 
                                desc');

            if(view()->exists('saida.out')) {
                return view('saida.out')->with('saida',$saida);
            }
    }
}
