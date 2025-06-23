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
        Schema::create('produtos_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->float('nota');
            $table->string('titulo')->nullable();
            $table->string('descricao', 500)->nullable();
            $table->bigInteger('produto_id');
            $table->bigInteger('user_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('user_id')->references('id')->on('produtos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_avaliacoes');
    }
};
