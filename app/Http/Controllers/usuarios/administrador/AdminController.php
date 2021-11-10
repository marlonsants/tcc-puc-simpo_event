<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pessoa;
use App\Model\Adm_evento;
use App\Model\Adm_permissoes;
use App\Model\Eventos_acesso_id;
class AdminController extends Controller
{
    
    public function buscarPermissoes(Request $request){
    	$admin_id = $request->admin_id;
    	$permissoes = Adm_permissoes::buscaPermissoes($admin_id);
    	return $permissoes;
    }

	public function viewCadastrar(){

		return view('/usuarios/administradores/cadastrar_administrador');
	}

	public function editarPermissoes(Request $request){
		Adm_permissoes::deletarPermissoes($request->pessoa_id);
		Adm_permissoes::cadastrarPermissoes($request,$request->pessoa_id);
		$msg = "Permissões alteradas com sucesso";
		$request->session()->flash('msg', $msg);
		return redirect('administrador/editar/permissao')->withInput();
	}	

	public function viewEditarPermissoes(Request $request){

		$verificaAdm = Eventos_acesso_id::select('pessoa_id')
						->where('acesso_id',4)
						->where('evento_id',session('evento_id') )
						->get();
		if(!empty($verificaAdm[0]) ){

			$administradores = Adm_permissoes::buscaAdmin();

			if(empty($administradores[0]) ){
				return view('/usuarios/administradores/cadastrar_administrador');
			}else{
					
				$permissoes = Adm_permissoes::buscaPermissoes($administradores[0]->id);	
				return view('/usuarios/administradores/cadastrar_administrador',compact('administradores','permissoes'));
			}
		}else{
			return redirect()->back();
		}
		
	}
    
    public function cadastrarAdm(Request $request){ //Inicio da função para cadastrar novo adm

		$evento_id = session()->get('evento_id');
		$e_mail = $request->e_mail;

		$pessoa = Pessoa::select('id')
		->where('email', '=', $e_mail)
		->get();
		
		if(!empty($pessoa[0]) ){ 
			$verificaTipoAutor = Eventos_acesso_id::select('pessoa_id')
			->where('pessoa_id', '=', $pessoa[0]->id)
			->where('evento_id',session('evento_id'))
			->where('acesso_id',1)
			->get();

			$verificaTipoAvaliador = Eventos_acesso_id::select('pessoa_id')
			->where('pessoa_id', '=', $pessoa[0]->id)
			->where('evento_id',session('evento_id'))
			->Where('acesso_id',2)
			->get();

		if(!empty($verificaTipoAutor[0])){
			$msg_erro = "Esta pessoa está participando do evento como autor, por isso não pode ser administrador(a)";
			$request->session()->flash('msg_erro', $msg_erro);
			return redirect('/administrador/cadastrar');
		}

		if(!empty($verificaTipoAvaliador[0])){
			$msg_erro = "Esta pessoa está participando do evento como avaliador, por isso não pode ser administrador(a)";
			$request->session()->flash('msg_erro', $msg_erro);
			return redirect('/administrador/cadastrar');
		}



		// dd($pessoa[0]);

		if (empty($pessoa[0]) ){ //Verifica se o email digitado existe no banco
			$msg_erro = "E-mail não encontrado na base de dados!";
			$request->session()->flash('msg_erro', $msg_erro);
			return redirect('/administrador/cadastrar');
			}

		else{
			$verificaEmail = Eventos_acesso_id::select('pessoa_id')
			->where('pessoa_id', '=', $pessoa[0]->id)
			->where('evento_id',session('evento_id'))
			->where('acesso_id',3)
			->get();

			//dd($verificaEmail);

			if (empty($verificaEmail[0]) ){ //Verifica se o email digitado ja esta cadastrado como adm
				$dadosToSave = array(
				'pessoa_id' => $pessoa[0]->id,
				'evento_id' => $evento_id,
				'acesso_id' => 3
				);

				$adm_evento = new Eventos_acesso_id();
				// faz o insert de um novo administrador
				$adm_evento->create($dadosToSave);
				// faz o insert das permissoes do administrador
				Adm_permissoes::cadastrarPermissoes($request,$pessoa[0]->id);

				$msg = "Cadastro Feito com sucesso";
				$request->session()->flash('msg', $msg);
				return redirect('/administrador/cadastrar');
			}else{
				$msg_erro = "Esta pessoa já está cadastrada como Administrador";
				$request->session()->flash('msg_erro', $msg_erro);
				return redirect('/administrador/cadastrar');
			}

		}
		
	// fim do if que verifica se pessoa existe	
	}else{
		$msg_erro = "E-mail não encontrado na base de dados!";
			$request->session()->flash('msg_erro', $msg_erro);
			return redirect('/administrador/cadastrar');
	}	
	} // fim de cadastrarAdm()
}
