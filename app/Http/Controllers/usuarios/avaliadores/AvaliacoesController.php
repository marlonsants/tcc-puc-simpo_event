<?php

namespace App\Http\Controllers\usuarios\avaliadores;

use Illuminate\Http\Request;
use Illuminate\Routing\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Model\Criterio;
use App\Model\Trabalho;
use App\Model\Parecer_avaliacao;
use App\Model\Avaliadores;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Notas;
use App\Model\Evento;
use Illuminate\Support\Facades\DB;
use App\Http\Util\GerarPdfUtil;

class avaliacoesController extends Controller
{
     public function ListarCriteriosAvaliador(Request $request){
        
        // verfica o tipo de requisição
        $trabalho_id = $request->id;
        $evento_id = session('evento_id');
        $avaliador_id = session('id');
        $Criterios    = Criterio::getCriterios($trabalho_id);
        $trabalho = Trabalho::buscaTrabalhoAtribuidosAoAvaliador($trabalho_id);
        $notaMax = Evento::maxNota();

        //dd($notaMax);

        if(isset($trabalho[0]) ){
           $trabalho     = $trabalho[0];
        }else{
            return redirect()->back();
        }
        
        $parecer      = Parecer_avaliacao::ParecerDoAvaliador($trabalho_id,$avaliador_id);
       
        
        if(!empty($parecer[0])){
            $parecer = $parecer[0];
        }else{
            $parecer = ' ';
        }

        return view('/usuarios/avaliadores/avaliarTrabalhos', compact('Criterios', 'trabalho','parecer', 'notaMax'));
    }

    public function concluir(Request $request){
        $trabalho_id = $request->trabalho_id;
        $notaFinal = Notas::notaFinal($trabalho_id);
        $notaFinal = $notaFinal[0]->notaFinal;
        
        // altera o status de Atribuicoes_avaliacoes para concluida = 3
        Atribuicoes_avaliacoes::concluirAvaliacao($trabalho_id);
        
        $qttdAvaliacoes = Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho_id);
        $avaliacoesConcluidas = Atribuicoes_avaliacoes::avaliacoesConcluidas($trabalho_id);
        // faz a divisão da nota pela quantidade de avaliadores
        $notaFinal = $notaFinal/$qttdAvaliacoes;
 
        $evento = Evento::find(session('evento_id'));
        
        $media = $evento->max_nota_trabalhos / 2;
        // verifica se quantidade de avaliação concluidas é igual a quatidade de avaliadores atribuidas a este trabalho, se for altera o status para trabalho avaliado
        if($qttdAvaliacoes == $avaliacoesConcluidas){
            Trabalho::alterarStatus($trabalho_id,2);
            return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
        }else{
            Trabalho::alterarStatus($trabalho_id,3);
            return redirect('/avaliador/trabalhos/avaliar/'.$trabalho_id.'');
        }
        

    }

    public function progresso(){

        $trabalho = new Trabalho();
        $trabalhos = $this->getListaProgressoAvaliacaoTrabalhos();
        $evento = new Evento();
        $datas = $evento->datasConf();
        $avaliadores = Atribuicoes_avaliacoes::buscaAtribuicoes();
        $maxAv = Evento::maxAvaliadorPorTrabalho();
        $maxAvaliadores = intval($maxAv[0]->max_avaliadores_trabalhos);
        $dataAtual = $datas['dataAtual'];
        $data_ini_ava = $datas['data_ini_ava'];

        $parecer_avaliacao = Parecer_avaliacao::buscaParecerAvaliador();
        return view('usuarios/administradores/progresso_avaliacoes', compact('trabalhos','dataAtual','data_ini_ava','maxAvaliadores','avaliadores','parecer_avaliacao'));
    }

    private function getListaProgressoAvaliacaoTrabalhos() {
        $trabalho = new Trabalho();
		$trabalhos =  $trabalho->buscaTodosTrabalhos();

        if(isset($trabalhos[0])){
            foreach ($trabalhos as $trabalho) {
               $concluida = Atribuicoes_avaliacoes::avaliacoesConcluidas($trabalho->id);
               $atribuida = Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho->id);
                // faz a criação de um novo item no objeto para guardar a quantidade de avaliadores
               $trabalho->avaliacoes_concluidas = $concluida;
               $trabalho->avaliacoes_atribuidas = $atribuida;
            }
        }else{
            $trabalhos = array();
        }

        return $trabalhos;
    }

    public function exportarProgressoAvaliacao() {
		$trabalhos =  $this->getListaProgressoAvaliacaoTrabalhos();
		$html = $this->getHtmlProgressoAvaliacaoParaExportacao($trabalhos);
        // return $html;
		GerarPdfUtil::gerarPdf($html);
	}

	private function getHtmlProgressoAvaliacaoParaExportacao($trabalhos){

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
		
		$html.= '<h4 class="text-center">Progresso das avaliações dos trabalhos</h4>
				<table  class="responsive-table" id="lista_progresso_avaliacoes">
					<thead>
						<tr>
                            <td>Trabalho</td>
                            <td>Progresso da avaliação</td>
                            <td>Avaliações concluídas</td>
                            <td>Status</td>
						</tr>
					</thead>
					<tbody>';
						foreach ($trabalhos as $trabalho){
							
		$html.=				'<tr>
								<td>'.$trabalho->titulo.'</td>';
                                if ($trabalho->avaliacoes_atribuidas == 0 || !isset($trabalho->avaliacoes_concluidas)) {
        $html.=                     '<td> 0 </td>';
                                } else {
        $html.=                     '<td>'.number_format(($trabalho->avaliacoes_concluidas/$trabalho->avaliacoes_atribuidas)*100,1) .'%</td>';
                                }
                                if (isset($trabalho->avaliacoes_concluidas)) {
        $html.=					'<td>'.$trabalho->avaliacoes_concluidas.' de '.$trabalho->avaliacoes_atribuidas.'</td>';
                                } else {
        $html.=					'<td>0 de '.$trabalho->avaliacoes_atribuidas.'</td>';
                                }
        
        $html.=					'<td>'.$trabalho->status.'</td>
							</tr>';
						}
		$html.=		'</tbody>
				</table>
			</body>
		</html>';

		return $html;
	}


}
