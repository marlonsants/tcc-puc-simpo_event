<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Adm_evento;
use App\Model\Evento;
use App\Model\Area;
use App\Model\Categoria;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class CategoriasController extends Controller
{
    public $categorias;

    public function __construct(Categoria $categoria){
    $this->categorias = $categoria;
    }


    public function criaCategoria(Request $request)
    {
        $dados = $request->all();

        $dadosToSave = array(
            'evento_id' => session('evento_id'),
            'nome' => $dados['nome'],
        );

        $Categoria = New Categoria();
        $Categoria->create($dadosToSave);

        return redirect('/administrador/cadastros_basicos/categorias');
    }

    public function listaCategorias(){
        $Categorias = DB::table('categorias')
            ->where('evento_id', '=', session('evento_id'))
            ->select('categorias.*')
            ->get();

        return view('/usuarios/administradores/cadastrar_categoria', compact('Categorias'));
    }

    public function UpdateCategorias(Request $request)
    {
        $dados = $request->all();

        DB::table('categorias')
            ->where('id', $dados['id'])
            ->where('evento_id', session('evento_id'))
            ->update(array(
                'nome' => $dados['nome']
            ));

        return redirect('/administrador/cadastros_basicos/categorias');
    }   

    public function deletaCategorias(Request $request){
        $dados = $request->all();
        DB::table('categorias')
            ->where('id','=',$dados['id'])
            ->delete();

        return redirect('/administrador/cadastros_basicos/categorias');
    }
}