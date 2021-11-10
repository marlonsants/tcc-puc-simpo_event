<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pessoa;
use App\Model\Documentos_pessoas;

class ServicesController extends Controller
{
    
	public function InsertDocumentos(){
		
		$listaDeDocumentos  = Pessoa::select('id','cpf')->get();
		$listaDeDocumentosPersistidos = array();
		echo "Numero de documento a serem persistidos na tabela documentos_pessoas: ".count($listaDeDocumentos)."<br><br>";
		
		try
		{
			foreach ($listaDeDocumentos as $key => $pessoa) {
				
				$documento_pessoa = Documentos_pessoas::where('numero',$pessoa->cpf)->where('pessoa_id',$pessoa->id)->get();
				$doc  = array('numero' => $pessoa->cpf, 'tipo_documento_id' => 1, 'pessoa_id' => $pessoa->id);
				if(!isset($documento_pessoa[0])){

					Documentos_pessoas::SetDocumento($doc);
					array_push($listaDeDocumentosPersistidos,$doc);
						
				}else{
					if(count($listaDeDocumentosPersistidos) > 0){
						echo "Documento encontrado na tabela documentos_pessoas".$documento_pessoa[0]."<br>";
						echo "Este documento já existe na tabela documentos_pessoas por isso não foi persistido "
						.json_encode($doc)."<br><br>";	
					}	
					
				}
					
			}
			
			echo "Quantidade de documentos persistidos: ".count($listaDeDocumentosPersistidos)."<br><br>";
			echo "Lista de documentos que foram inseridos<br><br>";

			foreach ($listaDeDocumentosPersistidos as $key => $doc) {
				if($key%2 == 0){
						echo "<br>";
					}	
					echo json_encode($doc)."----";
			}
				
				
				// Documentos_pessoas::SetDocumento($doc);
		}
		catch(Exception $e)
		{
			echo (	"Ocorreu um erro ao fazer a inserção dos documentos <br>".
				 	" A operação está sendo cancelada nenhuma alteração foi salva ".$e->getMessage()
				 );
			// Documentos_pessoas::delete()->all();
		}

	}


}
