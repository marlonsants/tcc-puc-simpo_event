<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Notas;
use App\Model\Trabalho;
use App\Model\User;
use DB;
use App\Http\Util\GerarPdfUtil;

class AtribuicoesController extends Controller
{
  public function insereAtribuicao()
  {
    $criteriosToSave = array(
      'evento_id' => session('evento_id'),
      'pessoa_id' => $_POST['id_avaliador'],
      'trabalho_id' => $_POST['id_artigo'],
      'status_id' => '1'
      );

    return Atribuicoes_avaliacoes::create($criteriosToSave);    
  }

  public function deleteAtribuicao()
  { 
    $trabalho_id = $_POST['id_artigo'];
    $avaliador_id = $_POST['id_avaliador'];

    $deleteAtribuicao = Atribuicoes_avaliacoes::where('trabalho_id',$trabalho_id)
    ->where('evento_id',session('evento_id'))
    ->where('pessoa_id',$avaliador_id)
    ->delete();

    if($deleteAtribuicao){
      // deleta as notas que o avaliador atribuiu ao trabalho
      Notas::deleteNota($trabalho_id,$avaliador_id);
      // se a quantidade de avaliadores for menor do que 1 atribui o status aguardando avaliação
      if( Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho_id) < 1 ){
        Trabalho::alterarStatus($trabalho_id,5);
      }
      return $deleteAtribuicao;
    }
    

   
  }

  public function totalAtribuicoesAvaliador()
  {
    return Atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
    ->where('pessoa_id',$_POST['id_avaliador'])
    ->count();
  }

  public function buscaTrabalhosAtribuirAvaliador()
  {
    
    $trabalhos = Trabalho::buscarTrabalhosParaAtribuicoes();
    return $trabalhos;
  }

  public function exportarAtribuicoesAvaliadores() {
		$trabalhos = Trabalho::buscarTrabalhosParaAtribuicoes();
		
		$html = $this->getHtmlAtribuicoesParaExportacao($trabalhos);

		return GerarPdfUtil::gerarPdf($html);
				
	}

	private function getHtmlAtribuicoesParaExportacao($trabalhos){

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
		
		$html.= '<h4 class="text-center">Lista de atribuiçoes de avaliadores</h4>
				<table  class="responsive-table" id="lista_trabalhos">
					<thead>
						<tr>
							<th>Título</th>
							<th>Área</th>
							<th>Categoria</th>
							<th>Nº de Avaliador(es)</th>
						</tr>
					</thead>
					<tbody>';
						foreach ($trabalhos as $trabalho){
							
		$html.=		'<tr>
								<td>'.$trabalho->titulo.'</td>
								<td>'.$trabalho->area.'</td>
								<td>'.$trabalho->categoria .'</td>
								<td>'.$trabalho->avaliacoes_atribuidas.'</td>
							</tr>';
						}
		$html.=		'</tbody>
				</table>
			</body>
		</html>';

		return $html;
	}


}
