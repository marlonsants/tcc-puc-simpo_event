<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pre_avaliacao extends Model
{
    public $timestamps = false;
    public $table = 'pre_avaliacao';
	protected $fillable = [
		'evento_id',
		'pre_avaliador_id',
		'trabalho_id',
		'observacao'    	
	];

	public function buscaParecerPreAv(){
		$parecer = Pre_avaliacao::select('*')->where('evento_id',session('evento_id'))->get();
		return $parecer;
	}

	public static function buscarTodosParecer(){
		$parecer = Pre_avaliacao::select('pessoas.id','pessoas.nome','pre_avaliacao.observacao','pre_avaliacao.trabalho_id')
		->join('pessoas','pessoas.id','pre_avaliacao.pre_avaliador_id')
		->where('evento_id',session('evento_id'))
		->get();
		return $parecer;
	}

	public static function getParecerPorAutor($autor_id){
	
	$parecer = Pre_avaliacao::select('pre_avaliacao.trabalho_id','pre_avaliacao.observacao')
	
		->join('trabalhos as t','t.id','pre_avaliacao.trabalho_id')
		->join('autores as a','a.trabalho_id', 't.id')
		->where('t.evento_id', session('evento_id'))
		->where('a.pessoa_id',$autor_id)
		->get();
		return $parecer;	
	}

	public static function buscarParecerDoPreAvaliador(){
		$parecer = Pre_avaliacao::select('pessoas.id','pessoas.nome','pre_avaliacao.observacao','pre_avaliacao.trabalho_id')
		->join('pessoas','pessoas.id','pre_avaliacao.pre_avaliador_id')
		->where('evento_id',session('evento_id'))
		->where('pessoas.id',session('id'))
		->get();
		return $parecer;
	}


	  public static function deleteParecer($trabalho_id){
      Pre_avaliacao::where('trabalho_id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->where('pre_avaliador_id',session('id'))
      ->delete();
  	}

  	
}
