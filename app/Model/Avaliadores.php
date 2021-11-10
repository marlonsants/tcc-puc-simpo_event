<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\User;
use DB;

class Avaliadores extends Model
{
    protected $table = 'avaliadores';
    public $timestamps = false;
    protected $fillable = [
    	'pessoa_id',
    	'evento_id',
    	'area_id',
    	'status'
    ];

    static function getAreas(){
	    $area_id = Avaliadores::select('area_id')
					->where('pessoa_id',session('id'))
					->where('evento_id',session('evento_id'))
					->get();
		return $area_id;			
    }

    static function verificaTrabalho($avaliador_id,$trabalho_id){
    	$trabalho = atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
    	->where('pessoa_id',$avaliador_id)
    	->where('trabalho_id')
    	->get();

    	return $trabalho;
    } 

    
    static function buscaAvaliadores(){

        $result = DB::select( 
                    DB::raw("Select p.id, p.nome, p.instituicao, a.nome as area_descricao,av.pessoa_id, COUNT(atr.pessoa_id) as numeroDeAtribuicoes from avaliadores av 
                                INNER JOIN pessoas p ON p.id = av.pessoa_id
                                LEFT JOIN areas a ON a.id = av.area_id
                                LEFT JOIN atribuicoes_avaliacoes atr ON atr.pessoa_id = av.pessoa_id and atr.evento_id = ".session('evento_id')."
                                where av.status = 1
                                and av.evento_id = ".session('evento_id')."
                                GROUP by p.id,p.nome, p.instituicao, a.nome,av.pessoa_id
                                order By p.nome ") 
                );
        $user = new User();
        $avaliadores =  $user->newCollection($result);

        return $avaliadores;
    }
}
