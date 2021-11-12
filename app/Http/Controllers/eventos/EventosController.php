<?php 

namespace App\Http\Controllers\eventos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Evento;
use App\Model\Eventos_acesso_id;
use App\Model\Nivelacesso;
use App\Model\Area;
use App\Model\Avaliadores;
use App\Model\Adm_evento;
use App\Model\Pessoa;
use DB;
use Illuminate\Support\Facades\File;


class EventosController extends Controller
{
	private $evento;
	private $eventos_acesso_id;

	static public  function uploadLogoDoEvento(Request $request, $evento_id){
		// dd($request->all());
		$fileSource = $request->file('logoEvento');
		// dd($fileSource);
		$evento = Evento::find($evento_id);
		$logoIdOld = $evento->logo_id; 

		if($fileSource->isValid()){
			$destinationPath = env('DESTINATION_PATH_LOGO_EVENTO');
			
			// dd($destinationPath);
			$type = $fileSource->getMimeType();
			$size = $fileSource->getSize();
			$extensao = $fileSource->extension();
			$id = uniqid(rand());
			$fileName = $id.'.'.$extensao;
			// dd($fileName); 
			$fileError = $fileSource->getError();

			if($fileError == 0){
								
				// verifica se já existia uma logo salva para esse evento, caso exista apaga
				$pathArquivo = $destinationPath.'/'.$logoIdOld;
				if(isset($logoIdOld) && file_exists($pathArquivo)) {
					unlink($pathArquivo);
				}
				// faz upload da iamgem 
				$upload = $fileSource->move($destinationPath,$fileName);
				
				Evento::where('id',$evento_id)->update(['logo_id' => $fileName]);
			}
			else
			{
				$message = 'O arquivo selecionado não é uma imagem, selecione uma imagem e tente novamente';
			}

			
		}else{
			$message = 'Ocorreu um erro ao enviar o arquivo, verifique a integridade do arquivo e tente novamente, caso aconteça novamente entre em contato com a equipe de suporte atraves do email: system4college@gmail.com';
		}	
	}

	public function editar(){
		$evento = Evento::find(session('evento_id'));
		$verificaAdm = Eventos_acesso_id::select('pessoa_id')
						->where('acesso_id',4)
						->where('evento_id',session('evento_id') )
						->get();
		if(!empty($verificaAdm[0]) ){
			return view('.usuarios.administradores.criar_eventos',compact('evento'));	
		}else{
			return redirect()->back();
		}				

		
	}

	public function editarEvento(Request $request, $id){
		$dados = $request->all();
		$evento = Evento::find($id);
		$update = $evento->update($dados);

		try
		{	
			if($request->file('logoEvento') != null )
			{
				EventosController::uploadLogoDoEvento($request,$id);
			}
		}		
		catch (Exception  $e)
		{
			session()->flash('erro', "erro ao salvar a logo {$e->getMessage()}");
			return redirect('/administrador/editarEvento');
		}

		if($update){

			session()->put('evento_nome', $dados['nome_evento']);
			session()->flash('msg', 'Informações alteradas com sucesso');
			return redirect('/administrador/editarEvento');
		}else{
			session()->flash('erro', 'Erro ao alterar as informações do evento');
			return redirect('/administrador/editarEvento');
		}
	}

	public function __construct(Evento $evento,Eventos_acesso_id $eventos_acesso_id ){
		$this->evento = $evento;
		$this->eventos_acesso_id = $eventos_acesso_id;
		
	}

	public function getEvento($id){
		$evento = $this->evento->find($id);
		
		return $evento;
	}

	//cria um novo evento 
	public function novoEvento(Request $request){
		$evento = $request->except('cadastrar', '_token');
		$insert = Evento::create($evento);
		$eventoAcessoArray = array('pessoa_id' => session('id') , 'evento_id' => $insert->id, 'acesso_id' => 4);
		// cria um adm_master
		$insertAcessos = Eventos_acesso_id::create($eventoAcessoArray);
		//verifica se os registros foram cadastrados com sucesso 
		if($insert && $insertAcessos){
			// insere a logo do evento
			try
			{	
				if($request->file('logoEvento') != null )
				{
					EventosController::uploadLogoDoEvento($request,$insert->id);
				}
			}		
			catch (Exception  $e)
			{
				session()->flash('msg', "erro ao salvar a logo <br> {$e->getMessage()}");
				return redirect('/administrador/editarEvento');
			}

			return	redirect('/eventos');	//redireciona o administrador pra a tela de escolha do evento
		}else{
			echo"ERRO AO SALVAR";
		}
	}

	public function listarEventos(){
		$eventos = $this->evento->where('visible',true)->get();

		return view('usuarios/escolher_evento',compact('eventos'));
	}

	public function acessarEvento($id, Request $request){
		$evento_id = $id;

		$pessoa_id = session()->get('id');
		
		if($evento_id != '0'){
			$acesso = Eventos_acesso_id::getAcessoNoEvento($pessoa_id,$evento_id );
			
			if(isset($acesso[0]) && $acesso[0]->acesso_id != 0 ){

				$termo = Eventos_acesso_id::verificaTermoAceito($pessoa_id,$evento_id );

				

				if(isset($termo[0]) && $termo[0]->concorda_termos == '1'){
					
					$request->session()->put('acesso_id',$acesso[0]->acesso_id);
					$request->session()->put('evento_id',$evento_id);
					$request->session()->put('autenticado',true);
					switch ($acesso[0]->acesso_id) {
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
					$request->session()->put('evento_id',$evento_id);
					$request->session()->put('acesso_id',$acesso[0]->acesso_id);
					return redirect('/termo_compromisso');
				}
			}else{			
				$request->session()->put('evento_id',$evento_id);
				return redirect('/definir_acesso');
			}

		}else{
			return redirect()->back();
		}
	}



}
