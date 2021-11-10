<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Documentos_tipos extends Model
{
     protected $table = 'documentos_tipos';
   	public $timestamps = false;
    protected $fillable = [

    'id',
    'descricao'
    
    ];

    public static function GetTipos(){
    	return Documentos_tipos::all();
    }
}
