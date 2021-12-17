<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'tb_entrada';
    
    protected $fillable = [
        'nome',
        'marca',
        'medida',
        'qtde',
    ];

    protected $guarded = ['id'];
}
