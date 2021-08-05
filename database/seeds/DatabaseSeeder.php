<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProdutoTableSeeder::class);
    }
}

class ProdutoTableSeeder extends Seeder
{
    public function run()
    {
        DB::insert('INSERT INTO produtos (nome, valor, descricao, quantidade) 
        VALUES (?,?,?,?)', array('Geladeira', 5900.00, 
        'Side by Side com gelo na porta', 2));

        DB::insert('INSERT INTO produtos (nome, valor, descricao, quantidade) 
        VALUES (?,?,?,?)', array('Fogão', 950.00, 
        'Painel automático e forno elétrico', 5));

         DB::insert('INSERT INTO produtos (nome, valor, descricao, quantidade) 
        VALUES (?,?,?,?)', array('Microondas', 1520.00, 
        'Manda SMS quando termina de esquentar', 1));


    }
}
