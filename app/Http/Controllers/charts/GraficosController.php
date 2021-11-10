<?php

namespace App\Http\Controllers\charts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Trabalho;
use App\Model\Pessoa;
use App\Model\Avaliadores;
use App\Model\Autores;
use App\Model\Atribuicoes_avaliacoes;
use Charts;
use DB;

class GraficosController extends Controller{

    public function graficoAnalitico(){
        $trabalho = new Trabalho();
        $avaliador = new Avaliadores();
        $autor = new autores();
        $pessoa = new Pessoa();
        $trabalhos = $trabalho->buscaCategoriasEareasChart();
        $avaliadores = $avaliador->buscaAvaliadores();
        $autores = $autor->qtdAutores();
        $pessoas = $pessoa->buscaRegiao();
                
        if(!empty($autores[0]) ){
                 
        $qtdAutores = $autores[0]->qtd;
        }else{
          $qtdAutores = 0;
        }
        
	if(!empty($avaliadores[0]) ){
		$qtdAvaliadores= count($avaliadores);
        }else{$qtdAvaliadores = 0;}

       

	if(!empty($trabalhos) ){
                 
        $qtdTrabalhos = $trabalhos->count();
		$total = $trabalhos->where('status_id', '!=', 4)->count();
		$qtdTotal = $total;
		$qtd = $trabalhos->whereIn('status_id',[1,2,7,8,6] )->count();
		
	}

        
	if($qtd != 0){
        $chart = Charts::create('progressbar', 'progressbarjs')
            ->title("Progresso das Avaliações")
            ->values([$qtd,0,$qtdTotal])
            ->responsive(true);
	}else{
		$chart = Charts::create('progressbar', 'progressbarjs')
            ->title("Progresso das Avaliações")
            ->values([0,0,1])
            ->responsive(true);
	}	
        //graficos torta
        $chart2 = Charts::database($trabalhos, 'donut', 'morris')
            ->title("Trabalhos por Categoria")
            ->dimensions(170,170)
            ->groupBy('categoria_id','categoria');

        $chart3 = Charts::database($trabalhos->where('status_id','=','1'), 'donut', 'morris')
            ->title("Trabalhos Aprovados por Categoria")
            ->dimensions(170,170)
            ->groupBy('categoria_id','categoria');

        $chart4 = Charts::database($trabalhos->where('status_id','=',2 or 7), 'donut', 'morris')
            ->title("Trabalhos Avaliados por Categoria")
            ->dimensions(170,170)
            ->groupBy('categoria_id','categoria');

        $chart5 = Charts::database($trabalhos->where('status_id','=','4'), 'donut', 'morris')
            ->title("Trabalhos não Submetidos por Categoria")
            ->dimensions(170,170)
            ->groupBy('categoria_id','categoria');

        $chart6 = Charts::database($trabalhos, 'donut', 'morris')
            ->title("Trabalhos por Área")
            ->dimensions(170,170)
            ->groupBy('area_id','area');

        $chart7 = Charts::database($trabalhos->where('status_id','=','1'), 'donut', 'morris')
            ->title("Trabalhos Aprovados por Área")
            ->dimensions(170,170)
            ->groupBy('area_id','area');

        $chart8 = Charts::database($trabalhos->where('status_id','=',2 or 7), 'donut', 'morris')
            ->title("Trabalhos Avaliados por Área")
            ->dimensions(170,170)
            ->groupBy('area_id','area');

        $chart9 = Charts::database($trabalhos->where('status_id','=','4'), 'donut', 'morris')
            ->title("Trabalhos não Submetidos por Área")
            ->dimensions(170,170)
            ->groupBy('area_id','area');

        //
        $chart10 = Charts::database($pessoas, 'bar', 'morris')
            ->title("Autores Cadastradas por Estado")
            ->elementLabel('Estado')
            ->responsive(true)
            ->groupBy('estado');

        $chart11 = Charts::database($pessoas, 'bar', 'morris')
            ->title("Autores Cadastradas por Pais")
            ->elementLabel('Pais')
            ->responsive(true)
            ->groupBy('pais');

        return view('/usuarios/administradores/grafico_analitico', compact('qtdAutores','qtdAvaliadores','qtdTrabalhos','qtdTotal','qtd','chart','chart2','chart3','chart4','chart5','chart6','chart7','chart8','chart9','chart10','chart11'));
    }

}									