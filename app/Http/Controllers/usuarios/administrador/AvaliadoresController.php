<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\PessoasController;
use App\Model\Pessoa;
use App\Model\Avaliadores;
use App\Model\Trabalho;
use Illuminate\Support\Facades\DB;
use App\Http\Util\GerarPdfUtil;
class AvaliadoresController extends Controller
{ 
	private $avaliador;

	public function __construct(Avaliadores $avaliador){
		$this->avaliador = $avaliador;
	}

	public function listaAvaliadores(){
		$avaliadores = $this->getListaAvaliadores();
		return view('/usuarios/administradores/listar_avaliadores', compact('avaliadores'));
	}

	private function getListaAvaliadores() {
		$evento_id = session()->get('evento_id');
		$avaliadores = DB::table('avaliadores')
		->join('pessoas', 'pessoas.id',  '=', 'avaliadores.pessoa_id')
		->join('areas', 'avaliadores.area_id', '=', 'areas.id')
		->where('avaliadores.evento_id', '=', $evento_id)
		->select('pessoas.*','avaliadores.*','areas.nome as area')
		->orderBy('pessoas.nome')
		->get();

		return $avaliadores;
	}

	public function autenticaAvaliador($id,$acao){
		$avaliador = Avaliadores::find($id);
		if($acao == 'aprovar'){

			if($avaliador->status == 1){
				session()->flash('msg','Este avaliador já está aprovado');
				return redirect('administrador/avaliadores/listar');
			}

			$update = $this->avaliador->where('id',$id)
					  ->update(['status' => 1]);
			if($update){
				session()->flash('msg','Avaliador aprovado com sucesso');
				return redirect('administrador/avaliadores/listar');
			}else{
				session()->flash('msg','Ocorreu um erro ao fazer a aprovação do avaliador, entre em contato com os desenvolcedores do sistema');
				return redirect('administrador/avaliadores/listar');
			}		  
				
				
			
		}else{

			if($avaliador->status == 2){
				session()->flash('msg','Este avaliador já está reprovado');
				return redirect('administrador/avaliadores/listar');
			}

			$update = $this->avaliador->where('id',$id)
					  ->update(['status' => 2]);
			if($update){
				session()->flash('msg','Avaliador reprovado com sucesso');
				return redirect('administrador/avaliadores/listar');
			}else{
				session()->flash('msg','Ocorreu um erro ao fazer a reprovação do avaliador, entre em contato com os desenvolcedores do sistema');
				return redirect('administrador/avaliadores/listar');
			}	
		}
	}

		
		public function atribuicoesDosAvalidores(){

			$atribuicoes = Avaliadores::buscaAvaliadores();

			// dd($atribuicoes);

			return $atribuicoes;
		}

		public function GetAvaliadoresExcetoAutoresDoTrabalho($trabalho_id){
			$avaliadores = Trabalho::getAvaliadoresExcetoAutoresDoTrabalho($trabalho_id);
			 
			return $avaliadores;
		}


		public function exportarAvaliadores() {
			$avaliadores = $this->getListaAvaliadores();
			
			$html = $this->getHtmlAvaliadoresParaExportacao($avaliadores);
			
			GerarPdfUtil::gerarPdf($html);
		}

		private function getHtmlAvaliadoresParaExportacao($avaliadores){

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
			
			$html.= '<h4 class="text-center">Lista de avaliadores cadastrados</h4>
					<table  class="responsive-table" id="lista_autores">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Sobrenome</th>
								<th>Area</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>';
							foreach ($avaliadores as $avaliador){
								
			$html.=				'<tr>
									<td>'.$avaliador->nome.'</td>
									<td>'.$avaliador->sobrenome.'</td>
									<td>'.$avaliador->area.'</td>
									<td>';
										if ( $avaliador->status == 0 ) {
		    $html.=								'<p class="text-primary">Não verificado <span class="glyphicon glyphicon-question-sign"/></p>';
										}
										
										if ( $avaliador->status == 1 ) {
		    $html.=								'<p class="text-success">Cadastro aprovado <span class="glyphicon glyphicon-ok-sign"/></p>';
										}
										
										if ( $avaliador->status == 2) {
		    $html.=								'<p class="text-danger">Cadastro reprovado <span class="glyphicon glyphicon-remove-sign"/></p>';
										}
											
		    $html.=					'</td>
								</tr>';
							}
			$html.=		'</tbody>
					</table>
				</body>
			</html>';
	
			return $html;
		}

}


