<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
              `id` int NOT NULL AUTO_INCREMENT,
              `nome` varchar(255) NOT NULL,
              `telefone` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `endereco` varchar(255) NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP TABLE tb_fornecedor;');
    }
}
