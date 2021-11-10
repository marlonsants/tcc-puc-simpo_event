<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller\PessoasController;
use App\Model\Pessoa;
use App\Model\Autores;
use Illuminate\Support\Facades\DB;

class AutorController extends Controller
{ 
	private $pessoa;
	public function __construct(Pessoa $pessoa){
		$this->pessoa = $pessoa;
	}

	public function listaautores(){
		$evento_id = session()->get('evento_id');
		$autores = DB::table('trabalhos')
		->select('pessoas.*','consulta.trab_cad','consulta2.trab_env')
		->join('autores','trabalhos.id','autores.trabalho_id')
		->join('pessoas','autores.pessoa_id','pessoas.id')
		// consulta a quantidade de trabalhos enviados 
		->join (DB::raw("(select count(autores.id) as trab_env,autores.pessoa_id from autores
			join trabalhos ON trabalhos.id = autores.trabalho_id where trabalhos.status_id <> 0 and trabalhos.evento_id = {$evento_id} group by autores.pessoa_id) as consulta2"),
			'autores.pessoa_id','=','consulta2.pessoa_id')
		// consulta a quantidade de trabalhos cadastrados
		->join (DB::raw("(SELECT count(*) as trab_cad,pessoa_id from autores 
			where autores.evento_id = {$evento_id}
			group by pessoa_id) as consulta" ),'autores.pessoa_id','=','consulta.pessoa_id' )
		->distinct()
		->where('trabalhos.evento_id',$evento_id)  
		->get();
		// dd($autores);
		return view('/usuarios/administradores/listar_autores', compact('autores'));
	}

	
}

