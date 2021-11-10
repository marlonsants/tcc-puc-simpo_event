<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Evento;
use App\Model\Pre_avaliacao;
use App\Model\Trabalhos_correcoes;

class Pre_avaliacaoController extends Controller
{
    public function inserirParecer(Request $request){	

    	$data = Evento::datasConf();
		$dados= $request->all();
		$evento_id = session('evento_id');
		$trabalho_id 	= $dados['trabalho_id'];
		$avaliador_id 	= session('id');
		$parecer	= $dados['parecer'];

		// faz uma busca pra verificar se o parecer já foi inserido
		$buscaParecer = Pre_avaliacao::select('id')
		->where('evento_id',$evento_id)
		->where('trabalho_id',$trabalho_id)
		->where('pre_avaliador_id',$avaliador_id)
		->get();
		// se a nota não foi atribuida faz o insert senão faz o update
		if(empty($buscaParecer[0])){
			
			$ParecerToSave = array(
			'evento_id'		 => $evento_id,
			'trabalho_id' 	 => $trabalho_id,
			'pre_avaliador_id' 	 => $avaliador_id,
			'observacao'  	 => $parecer
			
			);

			$Nota = Pre_avaliacao::create($ParecerToSave);
			session()->flash('alertType','alert alert-success');
			session()->flash('mensagem', 'Observações registradas com sucesso');
		}else{
			Pre_avaliacao::where('evento_id',$evento_id)
			->where('trabalho_id',$trabalho_id)
			->where('pre_avaliador_id',$avaliador_id)
			->update(['observacao' => $parecer]);

			session()->flash('alertType','alert alert-success');
			session()->flash('mensagem', 'Observações alteradas com sucesso');

		}

		
		return redirect('/administrador/pre_avaliar');
	}

	public function deletarParecer(Request $request){
		$trabalho_id = $request->trabalho_id;
		
		Pre_avaliacao::deleteParecer($trabalho_id);
		session()->flash('alertType','alert alert-success');
		session()->flash('mensagem', 'Parecer de avaliação excluido com sucesso');
		return redirect('/administrador/pre_avaliar');
	
			
	}

	public function solcitarCorrecao($trabalho_id){
		$correcoes = new Trabalhos_correcoes();
		$correcao = $correcoes->where('trabalho_id',$trabalho_id)
		->get();
		// se já existir correção para este trabalho
		if(isset($correcao[0])){
			$correcao = $correcao[0];
			// se a correção já tiver sido enviada
			if($correcao->trabalho_status_id == 7){
				// muda o status para precisa de correção
				session()->flash('alertType','alert alert-info');
				session()->flash('mensagem','Nova solcitação de correção enviada com sucesso');
				$correcoes->alterarStatus($trabalho_id,6);
				return redirect()->back();	
			}else{
				session()->flash('alertType','alert alert-danger');
				session()->flash('mensagem','Solcitação de correção cancelada com sucesso');
				$correcoes->deletarCorrecao($trabalho_id);
				return redirect()->back();	
			}
		}else{
			$correcoes->novaCorrecao($trabalho_id);
			session()->flash('alertType','alert alert-success');
			session()->flash('mensagem','Solcitação de correção enviada com sucesso');
			return redirect()->back();	
		}
	}
	// fim do metodo solicitar correção
}
