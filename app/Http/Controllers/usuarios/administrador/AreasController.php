<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Adm_evento;
use App\Model\Evento;
use App\Model\Area;
use App\Model\Categoria;
use Illuminate\Support\Facades\DB;

class AreasController extends Controller
{
    public $Areas;
    public	function __construct(Area $Areas){
        $this->$Areas = $Areas;
    }

    public function criaArea(Request $request)
    {
        $dados = $request->all();
        $dadosToSave = array(
            /*'categoria_id' => $dados['categoria_id'] ,*/
            'evento_id' => session('evento_id'),
            'nome' => $dados['nome']
        );
        $Area = New Area;
        $Area->create($dadosToSave);

        return redirect('/administrador/cadastros_basicos/areas');
    }

    public function listaAreas(){
        $Categorias = New Categoria();

        /*$Categorias = DB::table('categorias')
            ->where('evento_id', '=', session('evento_id'))
            ->select('categorias.*')
            ->get();*/

        $Areas = DB::table('areas')
            ->where('areas.evento_id', '=', session('evento_id'))
            ->select('areas.*'/*, 'categorias.nome as categoria'*/)
            /*->join('categorias', 'categorias.id', '=', 'areas.categoria_id')*/
            ->get();

        /*return view('/usuarios/administradores/cadastrar_area', compact('Areas', 'Categorias'));*/
        return view('/usuarios/administradores/cadastrar_area', compact('Areas', 'Categorias'));
    }

    public function UpdateAreas(Request $request){
        $dados = $request->all();

        DB::table('areas')
            ->where('id', $dados['id'])
            ->where('evento_id', session('evento_id'))
            ->update(array(
                'nome' => $dados['nome']
                /*'nome' => $dados['nome'],
                'categoria_id' =>$dados['categoria_id']*/
            ));

        return redirect('/administrador/cadastros_basicos/areas');
    }

    public function deletaAreas(Request $request){
        $dados = $request->all();
        DB::table('areas')
            ->where('id','=',$dados['id'])
            ->delete();
        return redirect('/administrador/cadastros_basicos/areas');
    }
}