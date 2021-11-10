<?php

namespace App\Http\Controllers\usuarios\avaliadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Trabalho;
use App\Model\Avaliacoes;
use App\Model\Avaliadores;
use App\Model\Evento;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Criterio;
use DB;

class AvaliadorController extends Controller
{

	protected $trabalho;
	protected $avaliacoes;
	protected $avaliadores;
	protected $atribuicoes;

	public function __construct(Trabalho $trabalho, Avaliacoes $avaliacoes, Evento $evento, Atribuicoes_avaliacoes $Atribuicoes_avaliacoes, Avaliadores $avaliadores){
		$this->trabalho = $trabalho;
		$this->avaliacoes = $avaliacoes;
		$this->avaliadores = $avaliadores;
		$this->evento = $evento;
		$this->atribuicoes = $Atribuicoes_avaliacoes;
	}


	public function listarTrabalhos(Request $request){

		// $trabalhos = $this->atribuicoes->trabAtribuido('select');
		// dd($trabalhos);
		$evento_id = $request->session()->get('evento_id');
		$idUsuLogado = $request->session()->get('id');
		$evento = Evento::find($evento_id);
		$area = Avaliadores::getAreas();
		$avaliadorLogado = Avaliadores::where('pessoa_id',$idUsuLogado)->where('evento_id',$evento_id)->get();
		$avaliadorLogado = $avaliadorLogado[0];
		$instituicaoAvaliador = strtoupper( $request->session()->get('instituicao') );

		// verifica se a quantidade de atribuições é menor do que o limite imposto pelos administradores do evento 
		if( $this->atribuicoes->trabAtribuido('count') < $evento->num_trab_avaliador){

			$trabNaoAtribuido = $this->atribuicoes->trabNaoAtribuido();
						
			// verifica se existe trabalhos que ainda não foram atribuidos 
			if(!empty($trabNaoAtribuido[0])){

				foreach ($trabNaoAtribuido as $key => $value) {
					$naoPermitirAtribuicao = false;
					// if que testa a quantidade de avaladiores que o trabalho possui
					if($value->atrib_count < $evento->max_avaliadores_trabalhos){
						// faz uma consulta nos trabalhos que ainda possuem vaga de atribuiçao de acordo com o limite de avaliadores por trabalho
						$trabalhos = DB::table('trabalhos')->select('trabalhos.id','uploads.arquivo_id','autores.pessoa_id','trabalhos.area_id','pessoas.instituicao','atribuicoes_avaliacoes.pessoa_id as avaliador_id')
						->leftJoin( 'autores','autores.trabalho_id','=','trabalhos.id')
						->leftJoin('atribuicoes_avaliacoes','atribuicoes_avaliacoes.trabalho_id','=','trabalhos.id')
						->leftJoin('pessoas','autores.pessoa_id','=','pessoas.id')
						->leftjoin('uploads','trabalhos.id','uploads.trabalho_id')
						->where('autores.evento_id',$evento_id)
						->where('trabalhos.id',$value->trabalho_id)
						->get();
								
											
					// vericação das regras de atribuição automatica se qualquer uma delas for verdadeira artibui true a variavel naoPermitirAtribuicao para que o trbalho não seja atribuido

						if(!empty($trabalhos[0]) ){	
							foreach ($trabalhos as $indice => $trabalho) {
																
								if($trabalho->arquivo_id == null || $trabalho->pessoa_id == $idUsuLogado || $trabalho->area_id != $area[0]->area_id || $trabalho->avaliador_id == $idUsuLogado || $avaliadorLogado->status != 1){
									// atribui true a variavel naoPermitirAtribuicao pois o trbalho não passou no filtro
									$naoPermitirAtribuicao = true;						
								}

							} //fim do foreach que verifica todos autores e avaliadores do trabalhos	

							if($naoPermitirAtribuicao == false){
								// este trecho cria a atribuicao automática foi comentado para manter somente a atribuição manual ate rever a rotina
								// faz a atribuição do trabalho pois passou em todos os filtros
								// $atribuicaoArray = array('evento_id' => $evento_id ,'pessoa_id' => $idUsuLogado,'trabalho_id' => $value->trabalho_id,'status_id' => 1);
								// $this->atribuicoes->create($atribuicaoArray);
								
							}
							
							
						}else{
							return view('usuarios/avaliadores/avaliacoes',compact('trabalhos'));
						}
					
						// verifica se a quantidade de trabalhos atribuidos é maior ou igual ao limite de atribuições se for verdadeira para o for each
						if( $this->atribuicoes->trabAtribuido('count') >= $evento->num_trab_avaliador){
							break;
						}
						// fim do if que testa a quantidade de avaladiores do trabalho
					// se a quantidade de avalaidores para este trabalho for igual a quantidade definida pelos amnistradores pula pra o proximo objeto do array	
					}else{
						continue;
					}
				// fim do foreach principal
				}
				// retorna todos trabalhos atribuidos a este avaliador
				$trabalhos = $this->atribuicoes->trabAtribuido('select');
				return view('usuarios/avaliadores/avaliacoes',compact('trabalhos'));

			}else{
				// se não existir mais trabalhos sem atribuição retorna todos trabalhos que foram atribuidos ao avalaidor logado 
				$trabalhos = $this->atribuicoes->trabAtribuido('select');
				return view('usuarios/avaliadores/avaliacoes',compact('trabalhos'));

			}
		// se o numero de atribuições for maior ou igual ao limite de atribuições retorna os trabalhos que foram atribuidos e não faz novas atribuições	
		}else{

			$trabalhos = $this->atribuicoes->trabAtribuido('select');
			return view('usuarios/avaliadores/avaliacoes',compact('trabalhos'));

		}

	}

	public function instrucoes(){
		$criterio = new Criterio();
		$criterios = $criterio->mostraCriterios();
		$datas = Evento::datasConf();
		$evento = Evento::find(session('evento_id'));
		$data = $datas;
		$criterioCount = Criterio::where('evento_id',session('evento_id') )->count();

		return view('/usuarios/avaliadores/instrucoes', compact('criterios','data','evento','criterioCount'));
	}

	public function verificarSeEdaMesmaInstituicao($instituicao){
		$count = 0;
		$instituicaoAutor = explode(' ',strtoupper($instituicao) );
	// verifica se o autor é da mesma instituicao do avalaidor 
		foreach ($instituicaoAutor as $indice => $valor) {
			$resultado = preg_match("/".$valor."/", $instituicaoAvaliador, $matches);

			if($resultado === 1 & $valor != 'DE' & $valor != 'DO' & $valor != 'DA' & $valor != ' ' & $valor != 'UNIVERSIDADE'   & $valor != '-' & $valor != 'FACULDADE' & $valor != 'FEDERAL' & $valor != 'ESTADUAL'  ){
				$count++;
			}
		}

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

}
