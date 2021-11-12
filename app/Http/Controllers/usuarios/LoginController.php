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
use Socialite;

class LoginController extends Controller
{
	private $pessoaModel;
	const PROVIDER_LOGIN_GOOGLE = 'google'; 

	public function __construct(Pessoa $pessoa)
    {
        $this->pessoaModel = $pessoa;
    }
	
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

	/**
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
    	return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

		$emailUser = $user->getEmail();
		$pessoas = Pessoa::where('email', $emailUser)->get();

		if (isset($pessoas[0])) {
			$pessoa = $pessoas[0];
			
			$request->session()->put('id',$pessoa['id']);
			$request->session()->put('pessoa_nome',$pessoa['nome']);
			$request->session()->put('documento',$pessoa['documento'][0]['numero']);
			$request->session()->put('instituicao',$pessoa['instituicao']);
			$request->session()->put('email',$pessoa['email']);
			return redirect('/eventos');
		} else {
			$pessoa = [
						'email' => $emailUser,
						'provider_login_social' => Self::PROVIDER_LOGIN_GOOGLE,
						'status' => 'A',
						'nome' => $user->getName()];

			$pessoaCriada = $this->pessoaModel->create($pessoa);

			if (isset($pessoaCriada)) {
				$request->session()->put('id', $pessoaCriada->id);
				$request->session()->put('email', $pessoaCriada->email);
				$request->session()->put('provider_login_social', $pessoaCriada->provider_login_social);
				$request->session()->put('pessoa_nome', $pessoaCriada->nome);
				return redirect('/eventos');
			}
			
		}

		
		
    }

}
