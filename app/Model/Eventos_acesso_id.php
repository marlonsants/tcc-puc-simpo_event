<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Eventos_acesso_id extends Model
{
	protected $table ='eventos_acesso_id';
	public $timestamps = false;
	protected $fillable = [
		'pessoa_id',
		'evento_id',
		'acesso_id',
		'concorda_termos'

	];

	static function getAcessoNoEvento($pessoa_id,$evento_id){
		$acessos = Eventos_acesso_id::where('evento_id',$evento_id)
		->where('pessoa_id',$pessoa_id)
		->select('acesso_id')
		->get();
		return $acessos;				
	}

	static function insertAcesso_id(){

	}

	static function updateAcesso_id(){
		
	}

	static function verificaTermoAceito($pessoa_id,$evento_id){
		$acessos = Eventos_acesso_id::where('evento_id',$evento_id)
		->where('pessoa_id',$pessoa_id)
		->select('concorda_termos')
		->get();
		return $acessos;				
	}
}
