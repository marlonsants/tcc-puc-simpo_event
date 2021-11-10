<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perguntas extends Model
{
	protected $table ='perguntas';
	public $timestamps = false;
	protected $fillable = [
	'id',
	'pergunta'

	];

	static function getPerguntas(){
		$perguntas = Perguntas::select('*')
		->get();
		return $perguntas;				
	}


}