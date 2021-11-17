<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use DB;
use PDF;
use App\Model\Trabalho;
use App\Model\Pessoa;
use App\Model\Upload;
use App\Model\Autores;
use App\Model\Avaliadores;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Evento;
use App\Model\Notas;
use Storage;
use League\Flysystem\Filesystem;
use App\Model\Pre_avaliacao;
use App\Model\User;
use App\Model\Area;
use App\Model\Categoria;
use App\Http\Util\GerarPdfUtil;

function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
	    if ($strict) { 
	        foreach ($haystack as $item) 
	            if (isset($item->$needle_field) && $item->$needle_field === $needle) 
	                return true; 
	    } 
	    else { 
	        foreach ($haystack as $item) 
	            if (isset($item->$needle_field) && $item->$needle_field == $needle) 
	                return true; 
	    } 
	    return false; 
	} 

class TrabalhosController extends Controller
{	
	private $trabalho;

	public function __construct(Trabalho $trabalho, Request $request){
		$this->trabalho = $trabalho;
	}
	
	

	public function buscaTrabalhos(){
		$evento = new Evento();
		$datas = $evento->datasConf();
		$dataAtual = $datas['dataAtual'];
		$data_ini_ava = $datas['data_ini_ava'];

		$trabalhos = $this->getListaTrabalhos();
		
		return view('/usuarios/administradores/listar_trabalhos',compact('trabalhos','dataAtual','data_ini_ava'));
	}

	private function getListaTrabalhos() {
		$trabalhos = $this->trabalho->buscaTodosTrabalhos();
		
		foreach ($trabalhos as $key => $trabalho) {
			// busca a quantidade de avalidores do trabalho
			$qttdAvaliacoes = Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho->id);
			if($qttdAvaliacoes < 1){
				$trabalho->notaFinal = 0;
			}else{
				$notaFinal = Notas::notaFinal($trabalho->id);
        		$notaFinal = $notaFinal[0]->notaFinal/$qttdAvaliacoes;
        		$trabalho->notaFinal = $notaFinal;
			}
        }

		return $trabalhos;
	}

	public function buscaTrabalhosPreAvaliacao(){

		$trabalhos = $this->trabalho->buscaTodosTrabalhos();
		$pre_avaliacoes = Pre_avaliacao::buscarTodosParecer();
		$parecer = Pre_avaliacao::buscarParecerDoPreAvaliador();
		$evento = new Evento();
		$datas = $evento->datasConf();

		$dataAtual = $datas['dataAtual'];
		$data_ini_ava = $datas['data_ini_ava'];
		$data_fim_ava = $datas['data_fim_ava'];

		if(!empty($parecer[0]) and !empty($trabalhos[0])){
			foreach ($trabalhos as $trabalho) {
				foreach ($parecer as $p) {
					if($trabalho->id == $p->trabalho_id){
						// se o trabalho possuir observação insere a observação no objeto trabalho
						$trabalho->observacao = $p->observacao;
					}
				}
			}
		}


		return view('/usuarios/administradores/pre_avaliacao',compact('trabalhos','pre_avaliacoes','parecer','dataAtual','data_ini_ava','data_fim_ava'));
	}

	public function listarTrabalhosDoAutor($idAutor){
		$trabalhosAutor = Autores::trabalhosDoAutor($idAutor);
		
		if($trabalhosAutor){
			return response::json($trabalhosAutor);
		}else{
			return response::json('erro');
			
		}
	}

	
	public function visualizarTrabalho($trabalho_id){

		$id_trabalho = $trabalho_id;
		$id_arquivo = Upload::where('trabalho_id',$id_trabalho)
		->select('arquivo_id')
		->get();
		// verifica se o upload foi realizado com sucesso
		if(!empty($id_arquivo[0])){
			$filename = $id_arquivo[0]['arquivo_id'].'.pdf';
			$path = public_path('files/uploads/').$filename;

			return Response::make(file_get_contents($path), 200, [
				'Content-Type' => 'application/pdf',
				'Content-Disposition' => 'inline; filename="'.$filename.'"'
				]);
		}else{
			return redirect()->back();
		}

	}
	// fim da função visualizarTrabalho

	public function buscaAutoresDoTrabalho($trabalho_id){
		$autores = Trabalho::buscaAutoresDoTrabalho($trabalho_id);

		if($autores){
			return response::json($autores);
		}else{
			return response::json('erro ao buscar autores');
		}
	}



	public function buscaResumo($trabalho_id){
		$trabalhoInfo =  (object) array();

		$trabalhoInfo->resumo = Trabalho::buscaResumo($trabalho_id);
		$trabalhoInfo->autores = Trabalho::buscaAutoresDoTrabalho($trabalho_id);
		// dd($trabalhoInfo->resumo[0]->resumo);
		if($trabalhoInfo->resumo[0]){
			return response::json($trabalhoInfo);
		}else{
			return response::json('erro');
		}
	}

	public function delete(Request $request){
		$trabalho_id = $request->id_trabalho;
		$upload = Upload::buscaUpload($trabalho_id);
		// se tiver upload faça

		if(!empty($upload[0])){
			$arquivo_id = $upload[0]['arquivo_id'];
			$caminhoDoArquivo = public_path().DIRECTORY_SEPARATOR.'files/uploads/'.$arquivo_id.'.pdf';
			
			Trabalho::deleteTrabalho($trabalho_id);
			Autores::deleteAutores($trabalho_id);
			Upload::deleteUpload($trabalho_id);

			// verifica se o arquivo existe
			if(file_exists($caminhoDoArquivo) ) {
				unlink($caminhoDoArquivo);
			}
						
			return redirect('autor/trabalhos/listar');
		}else{
			Trabalho::deleteTrabalho($trabalho_id);
			Autores::deleteAutores($trabalho_id);
			return redirect('autor/trabalhos/listar');
		}
		

		
	}


	public function aprovarTrabalho($trabalho_id){
		// atribui 1 para aprovar o trabalho
		
		if(Trabalho::alterarStatus($trabalho_id,1)){
			session()->flash('msg','Trabalho aprovado com sucesso !');
			return redirect()->back();
		}else{
			session()->flash('msg','Ocorreu um erro ao aprovar o trabalho, entre em contato com os desenvolvedores do sistema');
			return redirect()->back();
		}

	}

	public function reprovarTrabalho($trabalho_id){
		// atribui 1 para aprovar o trabalho
		if(Trabalho::alterarStatus($trabalho_id,8)){
			session()->flash('msg','Trabalho reprovado com sucesso !');
			return redirect()->back();
		}else{
			session()->flash('msg','Ocorreu um erro ao reprovar o trabalho, entre em contato com os desenvolvedores do sistema');
			return redirect()->back();
		}

	}

	public function getAvaliadoresDoTrabalhoPeloId($trabalho_id){
		$avaliadores = Trabalho::getAvaliadoresDoTrabalhoPeloId($trabalho_id);
		
		return $avaliadores;
	}

	public function Editar($trabalho_id){
		$trabalho = Trabalho::buscaTrabalho($trabalho_id);
		$trabalho = $trabalho[0];
		$area = Area::where('evento_id',session('evento_id') )->get();
		$categoria = Categoria::where('evento_id',session('evento_id') )->get();
		$max_autores = Evento::select('max_autores')->where('id',session('evento_id'))->get();

		$maxAutores = $max_autores[0]->max_autores;

		$autores = Trabalho::buscaAutoresDoTrabalho($trabalho_id);
		// dd($trabalho,$autores,$maxAutores);
		// dd($autores);


		return view('.usuarios.autores.novotrabalho',compact('trabalho','autores','categoria','area','maxAutores'));
	}

	public function EditarTrabalho(Request $request,$trabalho_id){
		$evento_id = $request->session()->get('evento_id');
		$trabalho = Trabalho::find($trabalho_id);
		$trabalhoDoRequest = $request->except('_token','autores','_method');
		
		$update = $trabalho->update($trabalhoDoRequest);
		$autoresDoRequest = $request->only('autores');

		$autores = Trabalho::buscaAutoresDoTrabalho($trabalho_id);

		try
		{
			foreach ($autoresDoRequest['autores'] as $indice => $autorRequest) {
				
				// se o autor ainda não está cadastro faz o insert se já estiver cadastrado faz o update
				if (isset($autorRequest['id'])  ){
					if (!in_array_field($autorRequest['id'], 'id', $autores) ){
						$autoresArray = array('trabalho_id' => $trabalho_id , 'pessoa_id' => $autorRequest['id'], 'ordemDeAutoria' => $autorRequest['ordem'],'evento_id' => $evento_id);
						$insertautores = Autores::create($autoresArray);
					}else{
						$autor = Autores::find($autorRequest['autor_id']);
											
						$autor->update(['ordemDeAutoria' => $autorRequest['ordem'] ]);
					}
				}	 
			}

			foreach ($autoresDoRequest['autores'] as $indice => $autor) {
								
				// se o id do autor não esta nos dados de requisição ele deve ser excluido
				if ( !isset($autor['id'])  ){
					// echo "o autor {$autor['autor_id']} não está no request do form, por isso será excluído <br>";
					$autor = Autores::find($autor['autor_id']);
					$autor->delete();
				}
			}

			session()->flash('msg', 'Informações alteradas com sucesso');
			return redirect('autor/trabalhos/editar/'.$trabalho_id);

		}
		catch(Exception $e)
		{
			session()->flash('erro', 'Erro ao alterar as informações do trabalho '.$e->getMessage());
			return redirect('autor/trabalhos/editar/'.$trabalho_id);
		}
					
		
	}

	public function exportarTrabalhos() {
		$trabalhos = $this->getListaTrabalhos();
		
		$html = $this->getHtmlTrabalhosParaExportacao($trabalhos);

		return GerarPdfUtil::gerarPdf($html);
				
	}

	private function getHtmlTrabalhosParaExportacao($trabalhos){

		$html = "
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8'>
				<style type='text/css'>";
		$html.= GerarPdfUtil::getCssPdf();			
		$html.=	"</style>
			</head>
			<body>";
		
		$html.= '<h4 class="text-center">Lista de trabalhos cadastrados</h4>
				<table  class="responsive-table" id="lista_trabalhos">
					<thead>
						<tr>
							<th>Título</th>
							<th>Área</th>
							<th>Categoria</th>
							<th>Status</th>
							<th>Nota final</th>
						</tr>
					</thead>
					<tbody>';
						foreach ($trabalhos as $trabalho){
							
		$html.=				'<tr>
								<td>'.$trabalho->titulo.'</td>
								<td>'.$trabalho->area.'</td>
								<td>'.$trabalho->categoria .'</td>
								<td>'.$trabalho->status.'</td>
								<td>'.number_format($trabalho->notaFinal, 2).'</td>
							</tr>';
						}
		$html.=		'</tbody>
				</table>
			</body>
		</html>';

		return $html;
	}


}
