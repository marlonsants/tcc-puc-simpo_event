<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;

class ComprovanteController extends Controller
{
    
    public function visualizarComprovante (Request $request){
		
		$evento_id = session()->get('evento_id');
		$pessoa_id = session()->get('id');
		$trabalho_id = $request->id_trabalho;

		//dd($trabalho_id);

		$dadosPessoa = DB::table('autores')
		->join('pessoas', 'autores.pessoa_id', '=', 'pessoas.id')
		->join('trabalhos', 'autores.trabalho_id', '=','trabalhos.id')
		->join('documentos_pessoas', 'pessoas.id', '=','documentos_pessoas.pessoa_id')
		->select('pessoas.*','documentos_pessoas.numero as numero_documento')
		->where('trabalhos.id', "=", $trabalho_id)
		//->orderBy('autores.id')
		->orderBy('autores.ordemDeAutoria')
		->get();
		
		$dadosTrabalho = DB::table('trabalhos')
		->join('categorias', 'trabalhos.categoria_id', '=', 'categorias.id')
		->join('areas', 'trabalhos.area_id', '=', 'areas.id')
		->select('trabalhos.titulo', 'categorias.nome as categoria_nome', 'areas.nome as area_nome')
		->where('trabalhos.id', "=", $trabalho_id)
		->get();

		$dadosEvento = DB::table('eventos')
		->select('eventos.*')
		->where('eventos.id', '=', $evento_id)
		->get();

		$inicio_evento = explode('-',$dadosEvento[0]->inicio_evento);
		$inicio_evento = $inicio_evento[2].'/'.$inicio_evento[1].'/'.$inicio_evento[0];

		$fim_evento = explode('-',$dadosEvento[0]->fim_evento);
		$fim_evento = $fim_evento[2].'/'.$fim_evento[1].'/'.$fim_evento[0];

		$pdf = PDF::loadview('/usuarios/autores/comprovantepdf', compact('dadosTrabalho', 'dadosPessoa', 'dadosEvento','inicio_evento','fim_evento'));
		return $pdf->stream();
	}
	
}
