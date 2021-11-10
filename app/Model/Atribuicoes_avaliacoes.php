<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Atribuicoes_avaliacoes extends Model
{
	public $timestamps = false;
	protected $table = 'atribuicoes_avaliacoes';
	protected $fillable = [
		'evento_id',
		'pessoa_id',
		'trabalho_id',
		'status_id'


	];

    // função pra buscar todos trabalhos atribuidos ao avaliador logado 
	static function trabAtribuido($acao){
		$avaliador_id = session('id');
		$evento_id = session('evento_id');
		$trabalhosAtribuidos = DB::table('atribuicoes_avaliacoes')->select('trabalhos.id','trabalhos.titulo','trabalhos_status.descricao as status','areas.nome as area','categorias.nome as categoria','avaliacoes_status.descricao as status_avaliacao',
			DB::raw("(select SUM((notas.nota * criterios.peso)  / ( select sum(peso) from criterios where evento_id = {$evento_id} ) ) from notas left Join criterios ON notas.criterio_id = criterios.id where notas.trabalho_id = trabalhos.id AND notas.evento_id = {$evento_id} AND notas.avaliador_id = {$avaliador_id} ) as notaFinal"))
		->join( 'trabalhos','atribuicoes_avaliacoes.trabalho_id','=','trabalhos.id')
		->join( 'areas','areas.id','=','trabalhos.area_id')
		->join( 'categorias','categorias.id','=','trabalhos.categoria_id')
		->leftJoin('trabalhos_status','trabalhos_status.id','trabalhos.status_id')
		->Join('avaliacoes_status','avaliacoes_status.id','atribuicoes_avaliacoes.status_id')
		->where('atribuicoes_avaliacoes.evento_id',session('evento_id'))
		->where('atribuicoes_avaliacoes.pessoa_id','=',session('id')) 
		->get();
		if($acao == 'count'){
			return count($trabalhosAtribuidos);
		}
		if($acao == 'select'){
			return $trabalhosAtribuidos;
		}

	}

	// função para buscar os que trabalhos que ainda não foram atribuidos 

	static function trabNaoAtribuido(){
		$trabNaoAtribuido = DB::table('trabalhos')->select(DB::raw('count(atribuicoes_avaliacoes.trabalho_id) as atrib_count,trabalhos.id as trabalho_id') )
			->leftjoin('atribuicoes_avaliacoes','atribuicoes_avaliacoes.trabalho_id','=','trabalhos.id')
			->where('trabalhos.evento_id',session('evento_id'))
			->groupBy('trabalhos.id')
			->get();
		return $trabNaoAtribuido;	
	}

	// função criada para a view proggresso_avaliacoes
	public static function buscaAtribuicoes(){
		$atribuidas = Atribuicoes_avaliacoes::select('pessoas.*','areas.nome as area','avaliacoes_status.id as situacao','atribuicoes_avaliacoes.trabalho_id', 'avaliacoes_status.descricao as status_avaliacao')
			->join('pessoas','pessoas.id','=','atribuicoes_avaliacoes.pessoa_id')
            ->join('avaliadores','avaliadores.pessoa_id','=','atribuicoes_avaliacoes.pessoa_id')
            ->leftjoin('areas','avaliadores.area_id','=','areas.id')
            ->leftjoin('avaliacoes_status','atribuicoes_avaliacoes.status_id','avaliacoes_status.id')
            ->where('atribuicoes_avaliacoes.evento_id', session('evento_id'))
            ->where('areas.evento_id', session('evento_id'))
            ->distinct()
            ->get();

        //dd($atribuidas);
        return $atribuidas;
	}

	public function atribuidas(){
		$atribuidas = Atribuicoes_avaliacoes::select('*')
			->where('evento_id', session('evento_id'))
			->get();
		return $atribuidas;
	}

	public static function concluirAvaliacao($trabalho_id){
		Atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
		->where('pessoa_id',session('id'))
		->where('trabalho_id',$trabalho_id)
		->update(['status_id' => 3]);
	}

	public static function avaliacoesConcluidas($trabalho_id){
		$count = Atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
		->where('trabalho_id',$trabalho_id)
		->where('status_id',3)
		->count();
		return $count;
	}

	public static function qtddDeAvaliacoesDoTrabalho($trabalho_id){
		$count = Atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
		->where('trabalho_id',$trabalho_id)
		->count();
		return $count;
	}

	 static function buscaAtribuicoesAvaliadores(){
        $AtribuicoesAvaliadores =  DB::table('atribuicoes_avaliacoes')->select('*')
        ->join('pessoas','pessoas.id','atribuicoes_avaliacoes.pessoa_id')
        ->where('atribuicoes_avaliacoes.evento_id','=',session('evento_id'))
        ->get();
        return $AtribuicoesAvaliadores;
    }

    static function deleteTodasAtribuicoesDoTrabalho($trabalho_id){
    	Atribuicoes_avaliacoes::where('trabalho_id',$trabalho_id)
    	->where('evento_id',session('evento_id'))
    	->delete();
    }

    static function alterarStatus($trabalho_id,$status_id){
    	Atribuicoes_avaliacoes::where('trabalho_id',$trabalho_id)
    	->where('evento_id',session('evento_id'))
    	->where('pessoa_id',session('id'))
    	->update(['status_id' => $status_id]);
    }

   
}
