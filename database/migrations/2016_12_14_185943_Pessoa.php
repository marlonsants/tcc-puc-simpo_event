<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::Create('pessoas', function (Blueprint $table){
            $table->increments('id');
            $table->string('status', 1);
            $table->string('nome',75);
            $table->string('nascimento',10);
            $table->string('sexo',10);
            $table->string('logradouro',70);
            $table->string('numero',6);
            $table->string('complemento',50);
            $table->string('bairro',50);
            $table->string('cidade',50);
            $table->string('estado',2);
            $table->string('CEP',15);
            $table->string('pais',50);
            $table->string('instituicao',75);
            $table->string('cargo',75);
            $table->string('telefone',20);
            $table->string('celular',20)->nullable();
            $table->string('contato',20)->nullable();
            $table->string('email',100);
            $table->string('senha',70);            
            $table->string('acesso_id', 1);     
            $table->string('status_id', 1);
            $table->integer('grupo_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}