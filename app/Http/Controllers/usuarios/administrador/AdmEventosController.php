<?php
namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Adm_evento;
use App\Model\Evento;
use App\Model\Area;
use App\Model\Categoria;
use Illuminate\Support\Facades\DB;

class AdmEventosController extends Controller
{
	private $eventos;
	private $adm_eventos;

	public	function __construct(evento $eventos, Adm_evento $adm_eventos){
		$this->eventos = $eventos;
		$this->adm_eventos = $adm_eventos;
	}
	

	public function listaEventos(){
		$eventos = DB::table('eventos_acesso_id as ea')
		->join('eventos as e', 'e.id', '=', 'ea.evento_id')
		->where('ea.pessoa_id','=', session('id'))
		->select('e.*')
		->get();
		return view('usuarios/administradores/home', compact('eventos'));
	}

	public function selecionaEvento(Request $request){
		$dados = $request->all();
		session()->put('evento_id', $dados['evento_id']);

		$Categorias = new Categoria();
		$Categorias = DB::table('categorias')
		->where('categorias.evento_id','=',session('evento_id'))
		->get();

		$Areas = DB::table('areas')
		->where('areas.evento_id','=',session('evento_id'))
		->get();

		if(count($Categorias) <= 0){
			return redirect('administrador/cadastros_basicos/categorias');			
		}elseif (count($Areas) <= 0) {
			return redirect('administrador/cadastros_basicos/areas');	
		}else{
			return redirect('/administrador/analise/completa');
		}

	}

	
	
}
