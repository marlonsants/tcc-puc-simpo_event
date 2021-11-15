<?php

namespace App\Http\Controllers\eventos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Evento;
use App\Model\Eventos_acesso_id;
use App\Model\Nivelacesso;
use App\Model\Area;
use App\Model\Avaliadores;
use App\Model\Pessoa;

use DB;

class AcessoController extends Controller
{

	public function getAcesso(){

		$evento_id = session()->get('evento_id');
		$pessoa_id = session()->get('id');
		$nome_pessoa =  Pessoa::select('nome')->where('id',$pessoa_id)->get();
		$evento = Evento::find($evento_id);
		$acessos = Nivelacesso::select('*')->whereNotIn('id', [4])->get();
		$areas = Area::where('evento_id',$evento_id)->get();
		$arrayDatas = Evento::datasConf();
		$acesso = Eventos_acesso_id::getAcessoNoEvento($pessoa_id,$evento_id);
		// verifica se já possui acesso ao evento
		if(isset($acesso[0])){
			$possuiAcesso = true;
		}else{
			$possuiAcesso = false;
		}
		return view('usuarios/getAcesso',compact('evento','acessos','areas','nome_pessoa','arrayDatas','possuiAcesso'));
		
		
	}

	public function updateAcesso(Request $request){
		
		// dd($acesso['area']);
		
		$acesso = $request->acesso_id;
		$area_id = $request->area;
		$resposta = Eventos_acesso_id::where('evento_id',session('evento_id') )
		->where('pessoa_id',session('id') )
		->update(['acesso_id' => $acesso]); 
		
		if($resposta == true){
			if($acesso == 2){
				session()->flash('suc','Tipo de acesso alterado para Avaliador com sucesso !');
				$request->session()->pull('acesso_id');
				$request->session()->put('acesso_id',$acesso);
		
				return $this->acessarSistema($request);
			}else if($acesso == 1){
				session()->flash('suc','Tipo de acesso alterado para Autor com sucesso !');
				$request->session()->pull('acesso_id');
				$request->session()->put('acesso_id',$acesso);
				Avaliadores::where('evento_id',session('evento_id'))
				->where('pessoa_id',session('id'))
				->delete();
				
				return $this->acessarSistema($request);
			}
			
			
			
		}else{
			session()->flash('msg','O tipo de acesso selecionado deve ser diferente do atual');
			return redirect()->back();
		}
	}

	public function getTermo(){

		$evento_id = session()->get('evento_id');
		$pessoa_id = session()->get('id');
		$pessoa =  Pessoa::find($pessoa_id);
		$evento = Evento::find($evento_id);
		$acessos = Nivelacesso::all();
		$areas = Area::all();
		$arrayDatas = Evento::datasConf();
		
		$termo = Eventos_acesso_id::verificaTermoAceito($pessoa_id,$evento_id );
		if(isset($termo[0]) && $termo[0]->concorda_termos == '1'){
			return view('usuarios/getAcesso',compact('evento','acessos','areas','pessoa','arrayDatas'));
		}else{
			return view('site.termo_compromisso',compact('evento','pessoa'));
		}
	}

	public function aceitarTermo(Request $request)
	{ 
		$aceito = ($request->aceito == 'on') ? '1' : '0';
		$acesso_id = session('acesso_id');
		DB::table('eventos_acesso_id')
		->where('pessoa_id', $request->pessoa_id)
		->where('evento_id', $request->evento_id)
		->update(array(
			'concorda_termos' => $aceito
		));

		$pessoa_id = session()->get('id');
		$evento_id = session()->get('evento_id');
		
		if($aceito == '1'){

		// Autentica o usuário <importante>
			$request->session()->put('autenticado',true);

			switch ($acesso_id) {
				case 1:
				return redirect('/autor/trabalhos/listar');
				break;
				case 2:
					return Evento::verificarInicioDaAvaliacao();					
				break;	
				case 3:
				return redirect('/administrador/analise/completa');
				break;		
				case 4:
				return redirect('/administrador/analise/completa');
				break;		
			}
		}else{
			return redirect('/termo_compromisso');

		}

		
	}


	public function acessarSistema(Request $request){

		$acesso_id = $request->only('acesso_id');
		$area_id = $request->only('area');
		$pessoa_id = session()->get('id');
		$evento_id = session()->get('evento_id');
		
		$acesso =	Eventos_acesso_id::getAcessoNoEvento($pessoa_id,session('evento_id') );

		Avaliadores::where('pessoa_id',$pessoa_id)->delete();
		// se o tipo de acesso for avaliador cria um registro na tabela de avaliadores		
		if($acesso_id['acesso_id'] == 2){
			$avaliadorerray = array('pessoa_id' => $pessoa_id , 'evento_id' => $evento_id, 'area_id' => $area_id['area'],'status' => 0);	
			$insert = Avaliadores::create($avaliadorerray);
		}
		if(!isset($acesso[0]) ){
			$eventoAcessoArray = array('pessoa_id' => $pessoa_id , 'evento_id' => $evento_id, 'acesso_id' => $acesso_id['acesso_id']);
			// cria o tipo de acesso na tabela eventos_acesso_id <importante> !!!!
			$insert = Eventos_acesso_id::create($eventoAcessoArray);
		} 
		

		
			$request->session()->put('acesso_id',$acesso_id['acesso_id']);
			$request->session()->put('evento_id',$evento_id);
			$request->session()->put('autenticado',true);
			// dd(session('evento_id'));		
			$termo = Eventos_acesso_id::verificaTermoAceito($pessoa_id,$evento_id );

			if(isset($termo[0]) && $termo[0]->concorda_termos == '1'){
				switch ($acesso_id['acesso_id']) {
					case 1:

					return redirect('/autor/trabalhos/listar');
					break;

					case 2:
					return Evento::verificarInicioDaAvaliacao();
					# code...
					break;
					case 3:
					return redirect('/administrador/analise/completa');
					# code...
					break;
					case 4:
					return redirect('/administrador/analise/completa');
					# code...
					break;
					default:
					# code...
					break;
				}
				if(isset($acesso[0])){
					redirect()->back();
				}
			}else{
				
				$pessoa =  Pessoa::find($pessoa_id);
				$evento = Evento::find($evento_id);
				return view('site.termo_compromisso',compact('evento','pessoa'));

			}

		

	}
}
