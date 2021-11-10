<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class documentosPpessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::Create('documentos_pessoas', function (Blueprint $table){
         $table->increments('id');
         $table->string('numero');
         $table->integer('id_tipo_documento');
         $table->integer('id_pessoa');
         
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::Drop('documentos_pessoas');
    }
}
