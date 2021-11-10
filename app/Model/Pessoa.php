<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;


class Pessoa extends Model
{

	protected  $fillable = [	
	'nome',
	'sobrenome',
	'nascimento',
	'sexo',
	'cidade',
	'estado',
	'pais',
	'instituicao',
	'titulo',
	'telefone',
	'celular',
	'email',
	'senha',
	'status',
	'pergunta_id',
	'resposta_seguranca',
	'grupo_id'
	];

	public function documento()
    {
        return $this->hasOne('App\Model\Documentos_pessoas','pessoa_id','id');
    }

	public function buscaRegiao(){
		$pessoa = DB::Table('pessoas')
		->join('autores', 'pessoas.id', '=', 'autores.pessoa_id')
		->select(DB::raw('distinct pessoas.id, pessoas.estado, pessoas.pais'))
		->where('autores.evento_id', session('evento_id'))
		->get();

		return $pessoa;
	}
	
	public function getPerguntaEmail($email){
		$pessoa = DB::Table('pessoas')
		->select('*')
		->leftjoin('perguntas', 'pessoas.pergunta_id', '=', 'perguntas.id')
		->where('pessoas.email', $email)
		->get();

		return $pessoa;
	}
	
	public function CPFAdministradores(){
		$cpf = DB::raw("SELECT a.cpf FROM pessoas a JOIN eventos_acesso_id b ON a.id = b.pessoa_id WHERE b.acesso_id in (3,4)");

		return $cpf;
		}
	}
