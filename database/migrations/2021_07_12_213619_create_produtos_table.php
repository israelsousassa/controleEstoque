<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_produto');
            $table->decimal('val_custo_cx', 5, 2);
            $table->decimal('val_custo_un',5, 2);
            $table->decimal('val_venda_cx',5, 2);
            $table->decimal('val_venda_un', 5, 2);
            $table->integer('qtde_cx');
            $table->integer('cx_un');
            $table->integer('qtde_un');
            $table->integer('code_barra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
