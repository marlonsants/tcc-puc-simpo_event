<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\Notas;
use App\Model\Trabalho;
use App\Model\User;
use DB;

class AtribuicoesController extends Controller
{
  public function insereAtribuicao()
  {
    $criteriosToSave = array(
      'evento_id' => session('evento_id'),
      'pessoa_id' => $_POST['id_avaliador'],
      'trabalho_id' => $_POST['id_artigo'],
      'status_id' => '1'
      );

    return Atribuicoes_avaliacoes::create($criteriosToSave);    
  }

  public function deleteAtribuicao()
  { 
    $trabalho_id = $_POST['id_artigo'];
    $avaliador_id = $_POST['id_avaliador'];

    $deleteAtribuicao = Atribuicoes_avaliacoes::where('trabalho_id',$trabalho_id)
    ->where('evento_id',session('evento_id'))
    ->where('pessoa_id',$avaliador_id)
    ->delete();

    if($deleteAtribuicao){
      // deleta as notas que o avaliador atribuiu ao trabalho
      Notas::deleteNota($trabalho_id,$avaliador_id);
      // se a quantidade de avaliadores for menor do que 1 atribui o status aguardando avaliação
      if( Atribuicoes_avaliacoes::qtddDeAvaliacoesDoTrabalho($trabalho_id) < 1 ){
        Trabalho::alterarStatus($trabalho_id,5);
      }
      return $deleteAtribuicao;
    }
    

   
  }

  public function totalAtribuicoesAvaliador()
  {
    return Atribuicoes_avaliacoes::where('evento_id',session('evento_id'))
    ->where('pessoa_id',$_POST['id_avaliador'])
    ->count();
  }

  public function buscaTrabalhosAtribuirAvaliador()
  {

    
    $trabalhos = Trabalho::buscarTrabalhosParaAtribuicoes();

    return $trabalhos;


  }


}
