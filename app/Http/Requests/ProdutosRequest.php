<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                #'nome' => 'required|min:5',
               # 'descricao' => 'required|max:255',
               # 'valor' => 'required|numeric',
                #'quantidade' => 'required|numeric',
                #'codigo' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return['required' => 'O campo :attribute não pode estar vazio.'];
    }
}
