<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\PessoasController;
use App\Model\Pessoa;
use App\Model\Avaliadores;
use App\Model\Trabalho;
use Illuminate\Support\Facades\DB;
class AvaliadoresController extends Controller
{ 
	private $avaliador;

	public function __construct(Avaliadores $avaliador){
		$this->avaliador = $avaliador;
	}
	public function listaAvaliadores(){
		$evento_id = session()->get('evento_id');
		$avaliadores = DB::table('avaliadores')
		->join('pessoas', 'pessoas.id',  '=', 'avaliadores.pessoa_id')
		->join('areas', 'avaliadores.area_id', '=', 'areas.id')
		->where('avaliadores.evento_id', '=', $evento_id)
		->select('pessoas.*','avaliadores.*','areas.nome as area')
		->orderBy('pessoas.nome')
		->get();
		return view('/usuarios/administradores/listar_avaliadores', compact('avaliadores'));
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

}


