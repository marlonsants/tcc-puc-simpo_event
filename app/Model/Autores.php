<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Autores extends Model
{
    protected $table = 'autores';
   	public $timestamps = false;
    protected $fillable = [

    'trabalho_id',
    'pessoa_id',
    'ordemDeAutoria',
    'evento_id'
    ];

     public static function deleteAutores($trabalho_id){
      Autores::where('trabalho_id',$trabalho_id)
      ->where('evento_id',session('evento_id'))
      ->delete();
  	}

  	public static function trabalhosDoAutor($idAutor){
      $trabalhos = DB::table('trabalhos')->select('trabalhos.id as id','trabalhos.titulo as titulo','areas.nome as area','categorias.nome as categoria','trabalhos_status.descricao as status','trabalhos_status.decoration', 'trabalhos.status_id')
      ->join('areas','areas.id','trabalhos.area_id')
      ->join('categorias','categorias.id','trabalhos.categoria_id')
      ->join('autores','autores.trabalho_id','trabalhos.id')
      ->join('trabalhos_status','trabalhos_status.id','trabalhos.status_id')
      ->where('autores.pessoa_id',$idAutor)
      ->where('trabalhos.evento_id',session('evento_id') )
      ->get();

      return $trabalhos;
   }

    public function buscaAutores(){
      $autores = DB::Table('autores')
        ->join('pessoas','autores.pessoa_id','pessoas.id')
        ->join('trabalhos','autores.trabalho_id','trabalhos.id')
        ->select('pessoas.*','trabalhos.titulo','autores.evento_id')
        ->where('autores.evento_id',session('evento_id'))
        ->orderBy('autores.ordemDeAutoria')
        ->get();
      return $autores;
    }

    public function qtdAutores(){
      $autores = DB::Table('autores')
        ->select(DB::raw('count(distinct pessoa_id) as qtd'))
        ->where('evento_id',session('evento_id'))
        ->get();
      return $autores;
    }
}
