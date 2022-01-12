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
        if(view()->exists('fornecedor.lista')) {
            return view('fornecedor.lista')->with('fornecedor', Fornecedor::all());
        }
    }

    public function addFornecedor(Request $request) 
    {
        Fornecedor::create($request->all());
        return redirect()->action('FornecedorController@fornecedor');
    }

    public function remover($id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->action('FornecedorController@fornecedor');
    }

    public function alterar($id)
    {
        return view('fornecedor.update')->with('a', Fornecedor::find($id));    
    }

    public function update(Request $request, $id) {
        
        $fornecedor = Fornecedor::find($id);
        
        if(!empty($fornecedor)) {
            $fornecedor->fill($request->input())->save();
            return redirect()->action('FornecedorController@fornecedor');
        }
         
    }
}
