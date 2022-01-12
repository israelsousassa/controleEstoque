<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE TABLE IF NOT EXISTS `tb_produtos` (
              `id` int NOT NULL AUTO_INCREMENT,
              `nome` varchar(255) NOT NULL,
              `marca` varchar(255) NOT NULL,
              `medida` varchar(255) DEFAULT NULL,
              `descricao` varchar(255) DEFAULT NULL,
              `valcusto` decimal(10,2) DEFAULT NULL,
              `uncaixa` bigint NOT NULL,
              `qtdecx` bigint DEFAULT 0,
              `qtdeun` bigint DEFAULT 0,
              `codebarra` bigint NOT NULL,
              `codebarracx` bigint DEFAULT NULL,
              `fornecedor` int DEFAULT NULL,
              `created_at` timestamp  NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `codebarra` (`codebarra`),
              UNIQUE KEY `codebarracx` (`codebarracx`),
              KEY `FK_fornecedor_produto` (`fornecedor`),
              CONSTRAINT `FK_fornecedor_produto` FOREIGN KEY (`fornecedor`) REFERENCES `tb_fornecedor` (`id`)
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
        \DB::statement('DROP TABLE tb_produtos;');
    }
}
