<?php

namespace App\Http\Controllers\usuarios\avaliadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Notas;
use App\Model\Evento;
use App\Model\Trabalho;
use App\Model\Atribuicoes_avaliacoes;
use Illuminate\Support\Facades\DB;


class NotasController extends Controller
{

	public $Nota;

	public function __construct(Notas $Notas)
	{
		$this->nota = $Notas;

	}
	public function avaliarCriterio(Request $request)
	{	
		$notaMax = Evento::maxNota();
		$dados= $request->all();
		$evento_id = session('evento_id');
		$trabalho_id 	= $dados['trabalho_id'];
		$avaliador_id 	= session('id');
		$criterio_id	= $dados['criterio_id'];
		$nota 			= $dados['nota'];	

		if (($nota < 0) || ($nota > $notaMax) ) {
			//$nota = 0;
			session()->flash('alertType','alert alert-danger');
			session()->flash('msgNotaMax', "As notas devem ser entre 0 e ".$notaMax.'');
			return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
		}

		$data = Evento::datasConf();
		if($data['dataAtual'] >= $data['data_fim_ava']){
			session()->flash('alertType','alert alert-danger');
			session()->flash('mensagem', 'O perido de avaliação já está encerrado, portanto a nota não pode ser alterada');
			return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');

		}
		// faz uma busca pra verificar se a nota para esse criterio ja foi atribuida
		$buscaNota = Notas::buscaNota($trabalho_id,$criterio_id);
		// se a nota não foi atribuida faz o insert senão faz o update
		if(!isset($buscaNota[0])){
			
			$notaToSave = array(
				'evento_id'		 => $evento_id,
				'trabalho_id' 	 => $trabalho_id,
				'avaliador_id' 	 => $avaliador_id,
				'criterio_id'  	 => $criterio_id,
				'nota' 			 => $nota
			);

			$Nota = $this->nota->create($notaToSave);

			// muda o status do trabalho e da avaliação para em avaliação quando é informado a nota pela primeira vez
			Atribuicoes_avaliacoes::alterarStatus($trabalho_id,2);
			Trabalho::alterarStatus($trabalho_id,3);					
								

		}else{
			Notas::updateNota($trabalho_id,$criterio_id,$nota);
		}	

		
		return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
	}

	
}
