<?php

namespace App\Http\Controllers\usuarios\avaliadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Parecer_avaliacao;
use App\Model\Evento;

class ParecerController extends Controller
{
    public function inserirParecer(Request $request){	

    	$data = Evento::datasConf();
		$dados= $request->all();
		$evento_id = session('evento_id');
		$trabalho_id 	= $dados['trabalho_id'];
		$avaliador_id 	= session('id');
		$parecer	= $dados['parecer'];

		if($data['dataAtual'] >= $data['data_fim_ava']){
				session()->flash('alertType','alert alert-danger');
				session()->flash('mensagem', 'O perido de avaliação já está encerrado, portanto o parecer de avaliação não pode ser alterado');
			return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');

		}
	
		// faz uma busca pra verificar se a nota para esse criterio ja foi atribuida
		$buscaParecer = Parecer_avaliacao::select('id')
		->where('evento_id',$evento_id)
		->where('trabalho_id',$trabalho_id)
		->where('avaliador_id',$avaliador_id)
		->get();
		// se a nota não foi atribuida faz o insert senão faz o update
		if(empty($buscaParecer[0])){
			
			$ParecerToSave = array(
			'evento_id'		 => $evento_id,
			'trabalho_id' 	 => $trabalho_id,
			'avaliador_id' 	 => $avaliador_id,
			'parecer'  	 => $parecer
			
			);

		$Nota = Parecer_avaliacao::create($ParecerToSave);
	}else{
		Parecer_avaliacao::where('evento_id',$evento_id)
		->where('trabalho_id',$trabalho_id)
		->where('avaliador_id',$avaliador_id)
		->update(['parecer' => $parecer]);

	}

		
		return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
	}

	public function deletarParecer(Request $request){
		$trabalho_id = $request->trabalho_id;
		$data = Evento::datasConf();
		// dd($data);
			if($data['dataAtual'] >= $data['data_fim_ava']){
				session()->flash('alertType','alert alert-danger');
				session()->flash('mensagem', 'O perido de avaliação já está encerrado, portanto o parecer de avaliação não pode ser excluido');
			return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');

			}else{
				Parecer_avaliacao::deleteParecer($trabalho_id);
				session()->flash('alertType','alert alert-success');
				session()->flash('mensagem', 'Parecer de avaliação excluido com sucesso');
				return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
			}
	

		
	}
}
