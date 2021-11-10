<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Avaliadores;

class Evento extends Model
{
	protected  $fillable = [	
		'nome_evento',
		'tema',
		'instituicao',
		'local_evento',
		'inicio_submissao',
		'fim_submissao',
		'inicio_inscricoes',
		'fim_inscricoes',
		'inicio_avaliacoes',
		'fim_avaliacoes',
		'inicio_evento',
		'fim_evento',
		'num_trab_autor',
		'max_autores',
		'max_avaliadores_trabalhos',
		'max_nota_trabalhos',
		'num_trab_avaliador',
		'logo_id',
		'visible'
	];

	public static function datasConf(){
		date_default_timezone_set('America/Sao_Paulo');
		$evento_id = session('evento_id');
		$pessoa_id = session('id');
		$evento = Evento::find($evento_id);
		$dataAtualStr = date('Y-m-d');
		$dataAtual = strtotime($dataAtualStr);

		$data_ini_sub_br = explode('-',$evento->inicio_submissao);
		$data_ini_sub_br = $data_ini_sub_br[2].'/'.$data_ini_sub_br[1].'/'.$data_ini_sub_br[0];

		$data_fim_sub_br = explode('-',$evento->fim_submissao);
		$data_fim_sub_br = $data_fim_sub_br[2].'/'.$data_fim_sub_br[1].'/'.$data_fim_sub_br[0];

		$data_ini_ava_br = explode('-',$evento->inicio_avaliacoes);
		$data_ini_ava_br = $data_ini_ava_br[2].'/'.$data_ini_ava_br[1].'/'.$data_ini_ava_br[0];

		$data_fim_ava_br = explode('-',$evento->fim_avaliacoes);
		$data_fim_ava_br = $data_fim_ava_br[2].'/'.$data_fim_ava_br[1].'/'.$data_fim_ava_br[0];

		$data_ini_sub = strtotime($evento->inicio_submissao);
		$data_fim_sub = strtotime($evento->fim_submissao);
		$data_ini_ava = strtotime($evento->inicio_avaliacoes);
		$data_fim_ava = strtotime($evento->fim_avaliacoes);

		$arrayDatas = array(
			'dataAtual' => $dataAtual,
			'data_ini_sub_br' => $data_ini_sub_br,
			'data_ini_sub' => $data_ini_sub ,
			'data_fim_sub_br' => $data_fim_sub_br,
			'data_fim_sub' => $data_fim_sub,
			'data_ini_ava' => $data_ini_ava,
			'data_fim_ava' => $data_fim_ava,
			'data_fim_ava_br' => $data_fim_ava_br,
			'data_ini_ava_br' => $data_ini_ava_br);
		
		return $arrayDatas; 
	}

	public static function verDatasAvaliacao(){
		$query = DB::table('eventos')
		->select('inicio_avaliacoes', 'fim_avaliacoes')
		->where('id',session('evento_id'))
		->get();
		return $query;
	}

	public static function verificarInicioDaAvaliacao(){
		$evento_id = session('evento_id');
		$pessoa_id = session('id');
		// datas do evento
		$data = Evento::find($evento_id);
		$data_ini_sub = strtotime($data->inicio_submissao);
		$data_fim_sub = strtotime($data->fim_submissao);
		$data_ini_ava = strtotime($data->inicio_avaliacoes);
		$data_fim_ava = strtotime($data->fim_avaliacoes);
		$dataAtualStr = date('Y-m-d');
		$dataAtual = strtotime($dataAtualStr);
		$data_ini_ava_br = explode('-',$data->inicio_avaliacoes);
		$data_ini_ava_br = $data_ini_ava_br[2].'/'.$data_ini_ava_br[1].'/'.$data_ini_ava_br[0];

		$avaliador = Avaliadores::where('pessoa_id',$pessoa_id)->where('evento_id',$evento_id)->get();
				// dd($dataAtual,$data_ini_ava,$data_ini_ava_br,$dataAtual - $data_ini_ava,$avaliador[0]->status,$dataAtualStr);
		if($dataAtual >= $data_ini_ava && $avaliador[0]->status == 1 ){

			return redirect('/avaliador/trabalhos');
		}else{
			session()->flash('mensagem', "O perído de avaliação ainda não foi iniciado ou seu cadastro como avaliador não foi aprovado pelos administradores por esse motivo você só tera acesso ao modulo de autor, as avaliações iniciam dia {$data_ini_ava_br} após essa data  caso seu cadastro seja aprovado pelos administradores do evento você terá acesso ao modulo de avaliação, agradecemos a compreensão");

			return redirect('/autor/trabalhos/listar');
		}
	}

	public static function verDatasSubmissao(){
		$query = DB::table('eventos')
		->select('inicio_submissao', 'fim_submissao')
		->where('id',session('evento_id'))
		->get();
		return $query;
	}

	public static function maxTrabalhoAvaliador(){
		$query = DB::table('eventos')
		->select('num_trab_avaliador')
		->where('id',session('evento_id'))
		->get();
		return $query;
	}

	public static function maxAvaliadorPorTrabalho(){
		$query = DB::table('eventos')
		->select('max_avaliadores_trabalhos')
		->where('id',session('evento_id'))
		->get();
		return $query;
	}

	public static function ver_nome_evento(){
		$query = DB::table('eventos')
		->select('nome_evento')
		->where('id',session('evento_id'))
		->get('nome_evento');
		return $query;
	}

	public static function maxNota(){
		$query = DB::table('eventos')
		->select('max_nota_trabalhos')
		->where('id',session('evento_id'))
		->get();
		$notaMax = $query[0]->max_nota_trabalhos;
		return $notaMax;
	}

	public static function maxAutores(){
		$query = DB::table('eventos')
		->select('max_autores')
		->where('id',session('evento_id'))
		->get();
		$max_autores = $query[0]->max_autores;
		return $max_autores;
	}
}
