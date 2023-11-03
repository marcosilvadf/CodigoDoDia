<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('foto', 100);
            $table->string('email', 100)->unique();
            $table->string('senha', 100);
            $table->tinyInteger('tipo');
            $table->timestamps();
        });

        Schema::create('dicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('titulo', 100);
            $table->string('descricao', 100);
            $table->string('slug', 100)->unique();
            $table->mediumText('html');
            $table->string('linguagem', 100);
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });

        Schema::create('criadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('imagem', 100);
            $table->string('titulo', 100);
            $table->string('descricao', 100);
            $table->string('slug', 100)->unique();
            $table->mediumText('html');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('criadores');
        Schema::dropIfExists('dicas');
        Schema::dropIfExists('usuarios');
    }
}