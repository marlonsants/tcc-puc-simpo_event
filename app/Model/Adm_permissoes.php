<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Pessoa;
use DB;

class Adm_permissoes extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'pessoa_id',
		'permissao_id',
		'evento_id'
	];

	static function buscaAdmin(){
		$admin = DB::table('pessoas as p')->select('p.id','p.nome')
					->join('eventos_acesso_id as a','a.pessoa_id','p.id')
					->where('evento_id',session('evento_id'))
					->where('a.acesso_id',3)
					->get();
		return $admin;			
	}
	static function buscaPermissoes($pessoa_id){
		$permissoes = DB::table('adm_permissoes')->Select('permissao_id')
						->where('evento_id',session('evento_id'))
						->where('pessoa_id',$pessoa_id)
						->get();
		
		if(!empty($permissoes[0])){
			$permissoes_array = [];
			foreach ($permissoes as $key => $value) {
				array_push($permissoes_array,$value->permissao_id); 

			}
			return $permissoes_array;
		}else{
			$permissoes_array = [1];
			return $permissoes_array;
		}				
						
	}

	static function deletarPermissoes($pessoa_id){
		Adm_permissoes::where('evento_id',session('evento_id'))
		->where('pessoa_id',$pessoa_id)
		->delete();
	}	

	static function cadastrarPermissoes($request,$pessoa_id){
		if(isset($request->autores)){
			$permissoes = ['pessoa_id' => $pessoa_id, 'permissao_id' => 1, 'evento_id' => session('evento_id')];
			Adm_permissoes::create($permissoes);
		}
		if(isset($request->trabalhos)){
			$permissoes = ['pessoa_id' => $pessoa_id, 'permissao_id' => 2, 'evento_id' => session('evento_id')];
			Adm_permissoes::create($permissoes);
		}
		if(isset($request->avaliadores)){
			$permissoes = ['pessoa_id' => $pessoa_id, 'permissao_id' => 3, 'evento_id' => session('evento_id')];
			Adm_permissoes::create($permissoes);
		}

		if(isset($request->cadastros)){
			$permissoes = ['pessoa_id' => $pessoa_id, 'permissao_id' => 4, 'evento_id' => session('evento_id')];
			Adm_permissoes::create($permissoes);
		}

		if(isset($request->pre_avaliador)){
			$permissoes = ['pessoa_id' => $pessoa_id, 'permissao_id' => 6, 'evento_id' => session('evento_id')];
			Adm_permissoes::create($permissoes);
		}
	}

	
}
