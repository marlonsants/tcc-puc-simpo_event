<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Trabalho;
use App\Model\Pessoa;
use App\Model\Autores;


class TrabalhoBuilder extends Controller
{
    public function build(Request $request){

    	
		$trabalho = $request->except(['_token']);
		// estatus 4 igual PDF não enviado
		$trabalho['status_id'] = 4;
		$trabalho['evento_id'] = session('evento_id');
		$autores = $trabalho['autores'];
		
		// inser os dados na tabela trabalhos 
		$insert = Trabalho::create($trabalho);
		// se os dados forem inseridos com sucesso
		if($insert){
			
			$trabalho_id =  $insert->id;
			$evento_id = $request->session()->get('evento_id');
			
			// if($insertautores){
			foreach ($autores as $key => $autor) {
				
				$autoresArray = array('trabalho_id' => $trabalho_id , 'pessoa_id' => $autor['id'], 'ordemDeAutoria' => $autor['ordem'],'evento_id' => $evento_id);

				$insertautores = Autores::create($autoresArray);
				// echo '<pre>';
				// echo var_dump($autoresArray);
				// echo '</pre>';
			}
						
			return redirect('autor/trabalhos/listar');
		}

	}
	// Fim da função novo trabalho

	

}
