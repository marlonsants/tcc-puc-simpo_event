<?php

namespace App\Http\Controllers\eventos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Trabalho;
use App\Model\Autores;
use App\Model\Upload;
use App\Model\Evento;
use DB;
use PDF;

class ResultadosController extends Controller
{
    public function buscaResultados(){
    	$trabalhos = Trabalho::buscaTodosAprovados(5);

    	// foreach ($trabalhos as $trab) {
    	// 	$trab->autores = Trabalho::buscaAutoresDoTrabalho($trab->id);

    	// }

    	return view('site.resultados',compact('trabalhos'));
    }

    public function buscaAnais($evento_id){
		$trabalho = new Trabalho();
		$anaisEvento = $trabalho->anaisEvento($evento_id);

		$pessoas = DB::table('pessoas')->select('pessoas.id','pessoas.nome','pessoas.sobrenome','trabalhos.id as trabalho_id')
			->join('autores','autores.pessoa_id','pessoas.id')
			->join('trabalhos','trabalhos.id','autores.trabalho_id')
			->orderBy('ordemDeAutoria')
			->get();

		return view('busca_anais', compact('anaisEvento','pessoas','evento_id'));
	}

	public function mostraAnais($evento_id, $trabalho_id){
		$upload = Upload::select()->where('trabalho_id', $trabalho_id)->get();
		$evento = Evento::select()->where('id', $evento_id)->get();

		$trabalho = DB::table('trabalhos')->select('trabalhos.id','trabalhos.titulo','areas.nome as area','categorias.nome as categoria','trabalhos.resumo','trabalhos.abstract','trabalhos.palavra_chave','trabalhos.key_word')
			->join('areas','areas.id','trabalhos.area_id')
			->join('categorias','categorias.id','trabalhos.categoria_id')
			->where('trabalhos.id',$trabalho_id)
			->where('trabalhos.evento_id', $evento_id)
			->get();

		$pessoas = DB::table('pessoas')->select('pessoas.id','pessoas.nome','pessoas.sobrenome','pessoas.email','pessoas.instituicao','pessoas.titulo','pessoas.cidade','pessoas.estado','pessoas.pais','pessoas.celular','pessoas.telefone'/*,'pessoas.cpf','pessoas.logradouro'*/)
			->join('autores','autores.pessoa_id','pessoas.id')
			->join('trabalhos','trabalhos.id','autores.trabalho_id')
			->where('autores.trabalho_id',$trabalho_id)
			->where('trabalhos.evento_id',$evento_id)
			->where('autores.evento_id',$evento_id)
			->orderBy('autores.ordemDeAutoria')
			->get();

		$nome_evento = $evento[0]['nome_evento'];
		$arquivo_id = $upload[0]['arquivo_id'];

		$arquivo = public_path('files/uploads/'.$arquivo_id.'.pdf');
		$banner = public_path('banners_png/banner_evento_'.$evento_id.'.png');

		$html = "
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8'>
				<meta name='keywords' content='".$trabalho[0]->palavra_chave.", ".$trabalho[0]->key_word.", ".$nome_evento.", ".$trabalho[0]->titulo."'>
				<meta name='description' content='pdf do artigo/trabalho: ".$trabalho[0]->titulo."'>
				<title>".$trabalho[0]->titulo."</title>

				<style type='text/css'>
					.pqn{font-size: 12px;}
					.med{font-size: 13px; text-transform: uppercase;}
					.center{text-align: center; margin-bottom: 10px;}
					.banner{width: 75%;}
					.justificado {text-align: justify; font-size: 13px}
					.justificado div{margin-bottom: 10px;}}
					body {font: sans-serif;}
				</style>
			</head>
			<body>
				<div class='center'>
					<div><img class='banner' src=".$banner."></div>
					<!--h4>".$nome_evento."</h4-->
					<h1 style='color: rgb(0,32,96); font-size: 24px;'><b>ANAIS</b></h1>
					<h4 style='text-transform: uppercase; margin-bottom: 0'>".$trabalho[0]->titulo."</h4>
				</div>
			";

		foreach ($pessoas as $autor) {
			$html .= "
				<div class='center'>
					<div class='med'>".$autor->nome." ".$autor->sobrenome."</div>
					<div class='pqn'>".$autor->email."</div>
					<div class='med'>".$autor->instituicao."</div>
				</div>
				";
		}

		$html.= "
			<div class='justificado'>
				<div><b>RESUMO:</b> ".$trabalho[0]->resumo."</div>
				<div><b>PALAVRAS CHAVE:</b> ".$trabalho[0]->palavra_chave."</div>
				<div><b>ABSTRACT:</b> ".$trabalho[0]->abstract."</div>
				<div><b>KEY WORDS:</b> ".$trabalho[0]->key_word."</div>
			</div>
		";

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle($trabalho[0]->titulo);

		$mpdf->WriteHTML($html);
		$mpdf->SetImportUse();
		$pagecount = $mpdf->SetSourceFile($arquivo);

		for ($i=1; $i<=($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }
		
		return $mpdf->Output($arquivo_id.".pdf","I");
	}

}