<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaNivelacessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::Create('nivelacessos', function (Blueprint $table){
         $table->increments('id');
         $table->string('descricao');
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
        Schema::Drop('nivelacessos');
    }
}
