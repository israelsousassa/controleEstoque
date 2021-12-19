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
        return redirect()->action('FornecedorController@fornecedor');
    }

    public function remover($id)
    {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();
        return redirect()->action('FornecedorController@fornecedor');
    }

    public function alterar($id)
    {
        $forn = Fornecedor::find($id);
        
            return view('fornecedor.update')->with('a',$forn);    
    }

    public function update(Request $request) {
        
        $id= $request->id;
        $fornecedor = Fornecedor::find($id);
        $sql = Fornecedor::where('id',$id)->get();
        if(!empty($sql)) {
            $fornecedor->fill($request->input())->save();
            return redirect()->action('FornecedorController@fornecedor');
        }
         
    }
}
