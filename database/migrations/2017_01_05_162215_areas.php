<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Areas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::Create('areas', function (Blueprint $table){
         $table->increments('id_area');
         $table->integer('id_evento');
         $table->string('nome');
         $table->string('cor');
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
        Schema::Drop('areas');
    }
}
