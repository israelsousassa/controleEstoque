<?php

namespace App\Http\Controllers;
use App\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FornecedorController extends Controller
{
    
    public function fornecedor()
    {
        $fornecedor = Fornecedor::all();
        if(view()->exists('fornecedor.lista')) {
            return view('fornecedor.lista')->with('fornecedor',$fornecedor);
        }
    }

    public function addFornecedor(Request $request) 
    {
        Fornecedor::create($request->all());
        return redirect()->action('ProdutoController@registra');
    }
}
