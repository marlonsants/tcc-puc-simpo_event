<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Notas extends Model
{
    protected $fillable = [
    	'evento_id',
    	'avaliador_id',
    	'trabalho_id',
    	'criterio_id',
    	'nota'    	
    ];

    public static function buscaNota($trabalho_id,$criterio_id){
    	$nota = Notas::select('id')
				->where('evento_id',session('evento_id'))
				->where('trabalho_id',$trabalho_id)
				->where('avaliador_id',session('id'))
				->where('criterio_id',$criterio_id)
				->get();
		return $nota;		
    }

    public static function updateNota($trabalho_id,$criterio_id,$nota){
    	Notas::where('evento_id',session('evento_id'))
		->where('trabalho_id',$trabalho_id)
		->where('avaliador_id',session('id'))
		->where('criterio_id',$criterio_id)
		->update(['nota' => $nota]);
    }

    public function buscaNotaCriterio($criterio_id, $trabalho_id){
		$nota = DB::table('notas')
		->where('criterio_id','=', $criterio_id)
		->where('trabalho_id','=', $trabalho_id)
		->get();

		return $nota;
	}

	public static function notaFinal($trabalho_id){
		$evento_id = session('evento_id');

		$notaFinal =  DB::table('notas')->select(DB::raw("(select SUM((notas.nota * criterios.peso)  / ( select sum(peso) from criterios where evento_id = {$evento_id} ) ) from notas left Join criterios ON notas.criterio_id = criterios.id where notas.trabalho_id = {$trabalho_id} AND notas.evento_id = {$evento_id} ) as notaFinal"))
		->groupBy('notaFinal')
		->get();
			
	
		return $notaFinal;
	}

	public static function notaFinalPorAvaliacao($trabalho_id,$avaliador_id){
		$evento_id = session('evento_id');

		$notaFinal =  DB::table('notas')->select(DB::raw("(select SUM((notas.nota * criterios.peso)  / ( select sum(peso) from criterios where evento_id = {$evento_id} ) ) from notas left Join criterios ON notas.criterio_id = criterios.id where notas.trabalho_id = {$trabalho_id} AND notas.evento_id = {$evento_id} AND notas.avaliador_id = {$avaliador_id} ) as notaFinal"))
		->groupBy('notaFinal')
		->get();
			
	
		return $notaFinal[0];
	}

	public static function deleteNota($trabalho_id,$avaliador_id){
		Notas::where('trabalho_id',$trabalho_id)
		->where('avaliador_id',$avaliador_id)
		->where('evento_id',session('evento_id'))
		->delete();
	}
}
