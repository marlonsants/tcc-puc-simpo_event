<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
     public $timestamps = false;
     protected $fillable = [
    	'evento_id',
    	'trabalho_id',
    	'arquivo_id'
    		
    ];

    public static function buscaUpload($trabalho_id){
    	$resultado = Upload::where('evento_id',session('evento_id'))
    	->where('trabalho_id',$trabalho_id)
    	->get();

    	return $resultado;
    }

      public static function deleteUpload($trabalho_id){
      Upload::where('trabalho_id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->delete();
  }
}
