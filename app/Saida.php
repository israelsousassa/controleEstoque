<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $table = 'tb_saida';
    protected $fillable = [
        'nome',
        'marca',
        'medida',
        'qtde',
    ];
    protected $guarded = ['id'];
}
