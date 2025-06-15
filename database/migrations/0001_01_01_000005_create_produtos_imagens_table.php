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
        Schema::create('produtos_imagens', function (Blueprint $table) {
            $table->id();
            $table->integer('posicao_lista');
            $table->integer('imagem_id');

            $table->foreign('imagem_id')->references('id')->on('imagens');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_imagens');
    }
};
