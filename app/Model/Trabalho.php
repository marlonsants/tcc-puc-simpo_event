<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Atribuicoes_avaliacoes;
use App\Model\User;

class Trabalho extends Model
{
   protected  $fillable = [	

   'titulo',
   'resumo',
   'palavra_chave',
   'abstract',
   'key_word',
   'area_id',
   'categoria_id',
   'status_id',
   'evento_id'
   
   ];

   public static function buscaAtribuicoes($trabalho_id){
      $atribuicoes = atribuicoes_avaliacoes::where('trabalho_id',$trabalho_id)
                      ->where('evento_id',session('evento_id'))
                      ->get();
      return $atribuicoes;                
   }
   public function buscaTodosTrabalhos(){
  
   		$trabalhos = DB::table('trabalhos')->select('trabalhos.id as id','trabalhos.titulo as titulo','areas.nome as area','categorias.nome as categoria','trabalhos_status.descricao as status', 'trabalhos.status_id','eventos.instituicao','trabalhos_status.decoration')
          ->join('areas','areas.id','trabalhos.area_id')
          ->join('categorias','categorias.id','trabalhos.categoria_id')
          ->join('trabalhos_status','trabalhos_status.id','trabalhos.status_id')
          ->join('eventos','eventos.id','trabalhos.evento_id')
          ->where('trabalhos.evento_id',session('evento_id'))
          ->orderBY('areas.nome')
          ->orderBY('trabalhos_status.descricao')
          

		  ->get();

		return $trabalhos;
   }

    public static function buscaTodosAprovados($evento_id){
  
      $trabalhos = DB::table('trabalhos')->select('trabalhos.id as id','trabalhos.titulo as titulo','areas.nome as area','categorias.nome as categoria','trabalhos_status.descricao as status', 'trabalhos.status_id','eventos.instituicao','trabalhos_status.decoration')
          ->join('areas','areas.id','trabalhos.area_id')
          ->join('categorias','categorias.id','trabalhos.categoria_id')
          ->join('trabalhos_status','trabalhos_status.id','trabalhos.status_id')
          ->join('eventos','eventos.id','trabalhos.evento_id')
          ->where('trabalhos.status_id',1)
          ->where('trabalhos.evento_id',$evento_id)
      ->get();

    return $trabalhos;
   }

   public function buscaCategoriasEareasChart(){
      $trabalhos = DB::table('trabalhos')->select(DB::raw("substr(areas.nome,1,15) as area"),DB::raw("substr(categorias.nome,1,15) as categoria"),'categorias.id as categoria_id','areas.id as area_id','status_id')
          ->join('areas','areas.id','trabalhos.area_id')
          ->join('categorias','categorias.id','trabalhos.categoria_id')
          ->join('eventos','eventos.id','trabalhos.evento_id')
          ->where('trabalhos.evento_id',session('evento_id'))
      ->get();

   return $trabalhos;
   }

   public static function buscaTrabalho($trabalhoId){
      $trabalhos = DB::table('trabalhos')->select('trabalhos.id','trabalhos.titulo','areas.nome as area','categorias.nome as categoria','trabalhos.resumo','trabalhos.abstract','trabalhos.palavra_chave','trabalhos.key_word','at.status_id as status_avaliacao','trabalhos.status_id','trabalhos.categoria_id','trabalhos.area_id')
    ->join('areas','areas.id','trabalhos.area_id')
    ->join('categorias','categorias.id','trabalhos.categoria_id')
    ->leftJoin('atribuicoes_avaliacoes as at','at.trabalho_id','trabalhos.id')
    ->where('trabalhos.id',$trabalhoId)
    ->where('trabalhos.evento_id', session('evento_id'))
    // ->where('at.pessoa_id',session('id'))
    ->get();

    return $trabalhos;
   }

   public static function buscaTrabalhoAtribuidosAoAvaliador($trabalhoId){
    $trabalhos = DB::table('trabalhos')->select('trabalhos.id','trabalhos.titulo','areas.nome as area','categorias.nome as categoria','trabalhos.resumo','trabalhos.abstract','trabalhos.palavra_chave','trabalhos.key_word','at.status_id as status_avaliacao','trabalhos.status_id','trabalhos.categoria_id','trabalhos.area_id')
    ->join('areas','areas.id','trabalhos.area_id')
    ->join('categorias','categorias.id','trabalhos.categoria_id')
    ->leftJoin('atribuicoes_avaliacoes as at','at.trabalho_id','trabalhos.id')
    ->where('trabalhos.id',$trabalhoId)
    ->where('trabalhos.evento_id', session('evento_id'))
    ->where('at.pessoa_id',session('id'))
    ->get();

    return $trabalhos;
   }

   public static function buscaResumo($trabalhoId){
      $trabalhos = DB::table('trabalhos')->select('trabalhos.id','trabalhos.resumo','trabalhos.abstract','trabalhos.key_word','trabalhos.palavra_chave')
      ->where('trabalhos.id',$trabalhoId)
      ->where('trabalhos.evento_id', session('evento_id'))
      ->get();

    return $trabalhos;
   }

   
    public static function buscaAutoresDoTrabalho($trabalho_id){
    
    if(session()->has('evento_id') ){
      $evento_id = session('evento_id');
    }else{
      $evento_id = 1;
    }

    $pessoa = DB::table('pessoas')->select('autores.id as autor_id','pessoas.id','pessoas.nome','pessoas.sobrenome','pessoas.email','pessoas.instituicao','pessoas.titulo','pessoas.cidade','pessoas.estado','pessoas.pais','pessoas.celular','pessoas.telefone','dt.descricao','doc.numero','autores.ordemDeAutoria')
      ->join('autores','autores.pessoa_id','pessoas.id')
      ->join('trabalhos','trabalhos.id','autores.trabalho_id')
      ->join('documentos_pessoas as doc','doc.pessoa_id','pessoas.id')
      ->join('documentos_tipos as dt','doc.tipo_documento_id','dt.id')
      ->where('autores.trabalho_id',$trabalho_id)
      ->where('trabalhos.evento_id', $evento_id)
      ->where('autores.evento_id',$evento_id)
      ->orderBy('autores.ordemDeAutoria')
      ->get();

      return $pessoa;

  }

  public static function deleteTrabalho($trabalho_id){
      Trabalho::where('id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->delete();
  }

  public static function alterarStatus($trabalho_id,$status_id){
     return Trabalho::where('id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->update(['status_id' => $status_id]); 
  }

  public static function getStatusId($trabalho_id){
      $trabalhos = DB::table('trabalhos')->select('status_id')
      ->where('trabalhos.id',$trabalho_id)
      ->where('trabalhos.evento_id', session('evento_id'))
      ->get();

      if(isset($trabalhos[0])){
        return $trabalhos[0]->status_id;
      }
  }

  public function anaisEvento($evento_id){
    $trabalhos = DB::table('trabalhos')->select('trabalhos.id as id','trabalhos.titulo as titulo','areas.nome as area','categorias.nome as categoria','eventos.instituicao','trabalhos.resumo as resumo')
    ->join('areas','areas.id','trabalhos.area_id')
    ->join('categorias','categorias.id','trabalhos.categoria_id')
    ->join('trabalhos_status','trabalhos_status.id','trabalhos.status_id')
    ->join('eventos','eventos.id','trabalhos.evento_id')
    ->where('trabalhos.status_id',1)
    ->where('trabalhos.evento_id',$evento_id)
    ->get();

    return $trabalhos;
  }

  public static function buscarTrabalhosParaAtribuicoes(){

    $result = DB::select( 
                          DB::raw("select t.id,t.titulo,a.nome as 'area',c.nome as 'categoria', COUNT(atr.id) as 'avaliacoes_atribuidas' from trabalhos t 
                                  LEFT join atribuicoes_avaliacoes atr ON t.id = atr.trabalho_id
                                  INNER JOIN areas a ON a.id = t.area_id
                                  INNER JOIN categorias c ON c.id = t.categoria_id
                                  where t.evento_id = ".session('evento_id')."
                                  GROUP by t.id,t.titulo,a.nome,c.nome

                                  ")
                        );  
    $user = new User();
    $Trabalhos =  $user->newCollection($result);

    return $Trabalhos;                
  }

  public static function getAvaliadoresDoTrabalhoPeloId($trabalho_id){

      $result = DB::select( 
                          DB::raw("select distinct p.id,p.nome,p.instituicao,a.nome as 'area',t.status_id as 'trabalho_status',t.id as 'trabalho_id' from atribuicoes_avaliacoes atr 
                                  INNER JOIN pessoas p ON p.id = atr.pessoa_id
                                  INNER join trabalhos t ON t.id = atr.trabalho_id
                                  LEFT JOIN areas a ON a.id = t.area_id
                                  INNER JOIN eventos_acesso_id ea on ea.pessoa_id = p.id 
                                  where t.id = {$trabalho_id}
                                  and ea.acesso_id = 2 
                                  and p.id not in( ( select pessoa_id from autores where trabalho_id = {$trabalho_id} ) )
                                  ")
                        );  
    $user = new User();
    $avaliadores =  $user->newCollection($result);

    return $avaliadores;

  }

  public static function getAvaliadoresExcetoAutoresDoTrabalho($trabalho_id){
      $evento_id = session('evento_id');
      $result = DB::select( 
                          DB::raw("select distinct p.id,p.nome,p.instituicao, 
                                   (select count(id) from atribuicoes_avaliacoes at 
                                      where p.id = at.pessoa_id 
                                   ) as 'numeroDeAtribuicoes' 
                                  from pessoas p
                                  INNER JOIN avaliadores av ON p.id = av.pessoa_id
                                  where  p.id not in( ( select pessoa_id from autores where trabalho_id = {$trabalho_id} ) )
                                  and av.evento_id = {$evento_id} 
                                  order by p.nome
                                  ")
                        );  
    $user = new User();
    $avaliadores =  $user->newCollection($result);

    return $avaliadores;

  }

}

   

