<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tb_produtos';

    protected $fillable = array(
        'nome', 
        'marca',
        'medida',
        'descricao',
        'valcusto',
        'uncaixa',
        'qtdecx',
        'qtdeun',
        'codebarra',
        'codebarracx',
        'data_hora'
    );

    protected $guarded = ['id'];
}
