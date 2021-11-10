<?php

namespace App\Http\Controllers\usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailNotFoundEmail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Model\Pessoa;
use App\Model\Eventos_acesso_id;
use App\Model\Adm_evento;
class LoginController extends Controller
{
	
	public function login(Request $request){
		$login = $request->all(); //Recebe dados do form login
		$search = Pessoa::where('email',  $login['email'])->get(); //consultado email no banco de dados
		
		if(isset($search[0])){ //Se encontrado no banco de dados
			$pessoa_id = $search[0]['id'];
			$pessoa = Pessoa::find($pessoa_id); //Variavel pessoa recebe informações da tabela pessoa
						
			if($login['email'] == $pessoa->email and md5($login['senha']) == $pessoa->senha){ //Se email e senha do form login confere
				$request->session()->put('id',$pessoa->id);
				$request->session()->put('pessoa_nome',$pessoa->nome);
				$request->session()->put('documento',$pessoa->documento->numero);
				$request->session()->put('instituicao',$pessoa->instituicao);
				$request->session()->put('email',$pessoa->email);
				return redirect('/eventos');
				
			}else{
				$msg_erro = "A senha não confere!";
				return view('site/login', compact('msg_erro'));
			}
		}else{ //Se não encontrado no banco de dados
			// Mail::to($login['email'])->send(new EmailNotFoundEmail($login));
			$msg_erro = "E-mail não encontrado na base de dados!";
			return view('site/login', compact('msg_erro'));
		}
	}


	public function acessaLogin(Request $request){
		$msg = $request->msg;
		return view('/site/login',compact('msg'));
	}

	
	public function logout(){
		session()->flush();
		return redirect('/login');
	}

}
