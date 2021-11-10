<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Parecer_avaliacao extends Model
{	
	public $table = 'parecer_avaliacao';
	protected $fillable = [
		'evento_id',
		'avaliador_id',
		'trabalho_id',
		'parecer'    	
	];

	public static function ParecerDoAvaliador($trabalho_id,$avaliador_id){
		$parecer = Parecer_avaliacao::select('*')
		->where('trabalho_id',$trabalho_id)
		->where('avaliador_id',$avaliador_id)
		->where('evento_id',session('evento_id'))
		->get();

		return $parecer;
	}

	public static function buscaTodosParecer(){
		$parecer = Parecer_avaliacao::select('*')
		->where('evento_id',session('evento_id'))
		->get();

		return $parecer;
	}

	public static function getParecerPorAutor($autor_id){
	
	$parecer = Parecer_avaliacao::select('parecer_avaliacao.trabalho_id','parecer_avaliacao.parecer')
	
		->join('trabalhos as t','t.id','parecer_avaliacao.trabalho_id')
		->join('autores as a','a.trabalho_id', 't.id')
		->where('t.evento_id', session('evento_id'))
		->where('a.pessoa_id',$autor_id)
		->get();
		return $parecer;	
	}

	  public static function deleteParecer($trabalho_id){
      Parecer_avaliacao::where('trabalho_id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->where('avaliador_id',session('id'))
      ->delete();
  }

  	public static function buscaParecerAvaliador(){
  		$parecer = DB::Table('parecer_avaliacao')->select('parecer_avaliacao.id','parecer_avaliacao.evento_id','avaliadores.pessoa_id','avaliadores.id as avaliador_id','parecer_avaliacao.trabalho_id','parecer_avaliacao.parecer')
  			->join('avaliadores', 'avaliadores.id','=', 'parecer_avaliacao.avaliador_id')
  			->where('parecer_avaliacao.evento_id',session('evento_id'))
  			->get();
  		return $parecer;
  	}
}
