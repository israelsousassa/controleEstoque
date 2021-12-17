<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{   
    protected $table = 'tb_fornecedor';
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco',
    ];
    protected $guarded = ['id'];
}
