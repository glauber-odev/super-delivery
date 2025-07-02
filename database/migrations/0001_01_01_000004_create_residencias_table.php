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
        Schema::create('residencias', function (Blueprint $table) {
            $table->id();
            $table->string('rua')->nullable();
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade');
            $table->string('cep')->nullable();
            $table->integer('user_id');
            $table->integer('estado_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estado_id')->references('id')->on('estados');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residencias');
    }
};
