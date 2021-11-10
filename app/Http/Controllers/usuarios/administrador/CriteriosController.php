<?php

namespace App\Http\Controllers\usuarios\administrador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\administradores;
use App\Model\Criterio;
use App\Model\Evento;
use App\Model\Trabalho;
use App\Model\Parecer_avaliacao;
use App\Model\Avaliadores;
use App\Model\Notas;
use App\Model\Atribuicoes_avaliacoes;
use Illuminate\Support\Facades\DB;


class CriteriosController extends Controller
{
    public $Criterios;
    public $Eventos;

    public function __construct(Criterio $Criterios, Evento $Eventos)
    {
        $this->Criterios = $Criterios;
        $this->Eventos = $Eventos;
    }

    public function buscaNotas($trabalho_id){
      $atribuicoes = Trabalho::buscaAtribuicoes($trabalho_id);
      $avaliacoes = array();
      
      foreach ($atribuicoes as $atr) {
        $notas = Criterio::buscaNotasCriterios($trabalho_id,$atr->pessoa_id);
        $notaFinal = Notas::notaFinalPorAvaliacao($trabalho_id,$atr->pessoa_id);
        $notas->push($notaFinal);
        array_push($avaliacoes, $notas);
        
      }
      $qttdAvaliacoes = Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho_id);
      $notaFinalDoTrabalho = Notas::notaFinal($trabalho_id);
      $notaFinalDoTrabalho = $notaFinalDoTrabalho[0]->notaFinal / $qttdAvaliacoes;

      array_push($avaliacoes,$notaFinalDoTrabalho);

      return response::json($avaliacoes);
    }

    public function setCriterio(Request $request)
    {
        if($this->Criterios->setCriterio($request)){
            flash('Cadastrado com sucesso','success');
        }else{
            flash('Erro ao realizar operação!','warning');
        }
        return  $this->ViewCadastrarCriterios();
    }


    public function ViewCadastrarCriterios()
    {
        $Criterios = Criterio::getCriterios();
        return view('/usuarios/administradores/cadastrar_criterios_avaliacao', compact('Criterios'));
    }

    public function UpdateCriterios(Request $request){
      $dados = $request->all();

      DB::table('criterios')
          ->where('id', $dados['id'])
          ->where('evento_id', session('evento_id'))
          ->update(array(
              'nome' => $dados['nome'],
              'descricao' => $dados['descricao']
          ));

      return redirect('/administrador/cadastros_basicos/criterios');
    }
   
    public function deletarCriterios(Request $request)
    {
      $dados = $request->all();
      $query =  Criterio::deletarCriterios($dados['id']);

      if($query){
          flash('Deletado com sucesso','success');
      }else{
          flash('Erro ao realizar operação!','warning');
      }
      return redirect('/administrador/cadastros_basicos/criterios');
  }
}
