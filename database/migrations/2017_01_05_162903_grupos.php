<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Grupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('grupos', function (Blueprint $table){
         $table->increments('id_grupo');
         $table->integer('id_evento');
         $table->integer('id_trabalho');
         $table->integer('id_usu_1');
         $table->integer('id_usu_2')->nullable();
         $table->integer('id_usu_3')->nullable();
         $table->integer('id_usu_4')->nullable();
         $table->integer('id_usu_5')->nullable();
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
        Schema::Drop('grupos');
    }
}
