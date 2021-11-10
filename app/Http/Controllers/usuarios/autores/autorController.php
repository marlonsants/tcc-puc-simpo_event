<?php

namespace App\Http\Controllers\usuarios\autores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use DB;
use App\Model\Trabalho;
use App\Model\Area;
use App\Model\Categoria;
use App\Model\Pessoa;
use App\Model\Autores;
use App\Model\Avaliacoes;
use App\Model\Evento;
use App\Model\Pre_avaliacao;
use App\Model\Parecer_avaliacao;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Notas;


class AutorController extends Controller
{
	private $trabalho;
	private $area;
	private $categoria;
	private $autores;
	private $pessoa;
	private $avaliacoes;
	private $evento;




	public function __construct(Trabalho $trabalho, Area $area, Categoria $categoria, Autores $autores, Pessoa $pessoa, Avaliacoes $avaliacoes, Evento $evento){
		$this->trabalho = $trabalho;
		$this->area = $area;
		$this->categoria = $categoria;
		$this->autores = $autores;
		$this->pessoa = $pessoa;
		$this->avaliacoes = $avaliacoes;
		$this->evento = $evento;
	}


	public function listarTrabalhos(Request $request){

		$datasSubmissao = Evento::verDatasSubmissao();
		$autor_id = session()->get('id');
		$evento_id = session()->get('evento_id');
		$trabalhos = Autores::trabalhosDoAutor($autor_id);
		$pre_avaliacoes = Pre_avaliacao::getParecerPorAutor($autor_id);
		$arrayDatas = $this->evento->datasConf();
		$parecer = Parecer_avaliacao::getParecerPorAutor($autor_id);
				
		$dataAtual = $arrayDatas['dataAtual'];
		$data_ini_ava = $arrayDatas['data_ini_ava'];

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
		
		return view('usuarios/autores/meus_trabalhos',compact('trabalhos','arrayDatas','parecer','pre_avaliacoes','datasSubmissao','dataAtual','data_ini_ava') );
	}

	public function submeterTrabalho(Request $request){
		
		$id_evento = $request->session()->get('evento_id');
		$max_trabalhos = $this->evento->find($id_evento);
		$autor_id = $request->session()->get('id');
		$area = $this->area->where('evento_id',session('evento_id') )->get();
		$categoria = $this->categoria->where('evento_id',session('evento_id') )->get();
		$max_autores = $this->evento->select('max_autores')->where('id',session('evento_id'))->get();

		$maxAutores = $max_autores[0]->max_autores;
		//dd($maxAutores);

		if(!empty($area[0])){
			$area = $area;

		}else{
			$area = $area[0] = [];
		}
		if(!empty($categoria[0])){
			$categoria = $categoria;
		}else{
			$categoria = $categoria[0] = [];
		}
		
		$arrayDatas = $this->evento->datasConf();
		$todosTrabalhos = Autores::trabalhosDoAutor($autor_id);

		$nTrabalhos = count($todosTrabalhos);

		if($arrayDatas['dataAtual'] > $arrayDatas['data_fim_sub'] ){
			session()->flash('msg', "Prazo de submissão encerrado dia {$arrayDatas['data_fim_sub_br']}");
			return redirect('autor/trabalhos/listar/?erro=2');

		}

		if($arrayDatas['dataAtual'] < $arrayDatas['data_ini_sub'] ){
			session()->flash('msg', "As submissões de trabalhos começam a partir do dia {$arrayDatas['data_ini_sub_br']}, só será permitido cadastrar trabalhos apartir desse dia ");
			return redirect('autor/trabalhos/listar/?erro=3');

		}

		if($nTrabalhos >= $max_trabalhos->num_trab_autor ){
			session()->flash('msg', 'Você já execedeu o limite de cadastro de trabalhos');
			return redirect('autor/trabalhos/listar/?erro=1');

		}

		return view('usuarios/autores/novotrabalho',compact('area','categoria','maxAutores'));

	}

	public function buscaCoautor(Request $request,$email){
		
		$id_evento = $request->session()->get('evento_id');
		$max_trabalhos = $this->evento->find($id_evento);
		$emailUsuLogado = $request->session()->get('email');


		$coautor = DB::table('pessoas')->select('pessoas.nome','pessoas.id')
		->where('pessoas.email','=',$email)
		->get();

		if(!isset($coautor[0])){
			return false;
		}

		$autor_id = DB::table('pessoas')->select('pessoas.id')
		->where('pessoas.email','=',$email)
		->get();

		$todosTrabalhos = Autores::trabalhosDoAutor($autor_id[0]->id);	
		
		$nTrabalhos = count($todosTrabalhos);

		
		if($nTrabalhos >= $max_trabalhos->num_trab_autor){

			$coautor = array('erro' => 'excedeu o limite');
			
			return Response::json($coautor);
			
		}

		return Response::json($coautor);
	}



	
}

