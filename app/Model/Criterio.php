<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Criterio extends Model
{ 	
	protected $fillable = [
		'evento_id',
		'nome',
		'descricao',
		'peso'

	];

	public static function getCriterios($trabalho_id = 0){
		$evento_id = session('evento_id');
		$Criterios = DB::table('criterios')
		->select('criterios.*','notas.nota')
		->Leftjoin('notas', function ($join) use ($trabalho_id) {
			$join->on('notas.criterio_id','criterios.id')
			->where('notas.evento_id','=',session('evento_id') )
			->where('notas.avaliador_id','=',session('id') )
			->where('notas.trabalho_id','=',$trabalho_id);
		})
		->where('criterios.evento_id',session('evento_id'))
		->orderBy('criterios.id')
		->get();

		return $Criterios;
	}

	public static function buscaNotasCriterios($trabalho_id,$avaliador_id){
		$evento_id = session('evento_id');
		$Criterios = DB::table('criterios as c')->select('c.nome','c.peso','n.nota')
						->leftJoin('notas as n','c.id','n.criterio_id')
						->where('c.evento_id', $evento_id)
						->where('n.avaliador_id',$avaliador_id)
						->where('n.trabalho_id',$trabalho_id)
						->get();

		return $Criterios;
	}

	public function setCriterio($request){
		$dados = $request->all();
		$criteriosToSave = array(
			'evento_id' => session('evento_id'),
			'nome' => $dados['nome'],
			'descricao' => $dados['descricao'],
			'peso' => $dados['peso']
		);
		
		return $this->create($criteriosToSave);


	}

	public static function deletarCriterios($id){
		$query =  DB::table('criterios')
		->where('id', '=', $id)
		->delete();

		return $query;
	}

	public function mostraCriterios(){
		$query = DB::table('criterios')
			->where('evento_id','=',session('evento_id'))
			->get();

		return $query;
	}    
}
