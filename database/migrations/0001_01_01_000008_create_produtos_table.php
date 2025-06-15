<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_produto');
            $table->string('titulo');
            $table->float('preco');
            $table->integer('saldo')->nullable();
            $table->string('descricao')->nullable();
            $table->bigInteger('categoria_id')->nullable();
            $table->bigInteger('produto_imagem_id')->nullable();
            $table->timestamps();

            $table->foreign('produto_imagem_id')->references('id')->on('produtos_imagens');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
