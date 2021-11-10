<?php

namespace App\Http\Controllers\trabalhos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Model\Trabalho;
use App\Model\Upload;


class UploadController extends Controller
{

	private $upload;

	public function __construct(Trabalho $trabalho){
		$this->trabalho = $trabalho;
	}

	public function upload(Request $request){

		$pdf = $request->file('pdf');
		$id_evento = $request->session()->get('evento_id');
		$pessoa_id = $request->session()->get('id');

		if($pdf->isValid()){
			$destinationPath = public_path().DIRECTORY_SEPARATOR.'files/uploads';
			$type = $pdf->getMimeType();
			$size = $pdf->getSize();
			$tipodef = "application/pdf";
			$tamanhodef = 1024*1024*2;
			$id = uniqid(rand());
			$fileName = $id.'.pdf'; 
			$fileError = $pdf->getError();
			$id_trabalho = $request->only('id_trabalho');
			
			$buscaUpload = Upload::buscaUpload($id_trabalho);

			if($type == $tipodef && $fileError == 0){

				if($size <= $tamanhodef){
					// verifica se este trabalho ja possui upload caso sim só substitui o pdf
					if(isset($buscaUpload[0]) && $buscaUpload[0] != ' '){
						$fileName = $buscaUpload[0]['arquivo_id'].'.pdf';
						if(file_exists($destinationPath.'/'.$fileName) ) {
							unlink($destinationPath.'/'.$fileName);	
							$upload = $pdf->move($destinationPath,$fileName);
						}else{
							$upload = $pdf->move($destinationPath,$fileName);
						}
						// se o upload for feito com sucesso 
						if($upload){
							$suc = 'Arquivo enviado com sucesso !';
							// se o trabalho possuir correção muda o status para corr~eção enviada pelo autor
							$trabalho_status_id = Trabalho::getStatusId($id_trabalho);
							if( $trabalho_status_id == 6){
								Trabalho::alterarStatus($id_trabalho,7);
							}else{
								Trabalho::alterarStatus($id_trabalho,5);
							}
							return redirect('autor/trabalhos/listar?suc='.$suc);
						}else{
							$msg_erro = 'Ocorreu um erro ao enviar o arquivo, verifique a integridade do arquivo e tente novamente, caso aconteça novamente entre em contato com a equipe de suporte atraves do site do evento';

							return redirect('autor/trabalhos/listar?msg_erro='.$msg_erro);
						}
					}
					// fim da verificação 
					// caso não tenha sido enviado ainda  faz o upload e o insert na tabela uploads
					$upload = $pdf->move($destinationPath, $fileName);

					if($upload){
						$uploadArray = array("evento_id" => $id_evento, "trabalho_id" => $id_trabalho['id_trabalho'], "arquivo_id" =>"{$id}");
						Upload::create($uploadArray);
						// altera o status para aguardando avaliação
						Trabalho::alterarStatus($id_trabalho,5);
						$suc = 'Arquivo enviado com sucesso !';
						
						return redirect('autor/trabalhos/listar?suc='.$suc);
					}else{
						$msg_erro = 'Ocorreu um erro ao enviar o arquivo, verifique a integridade do arquivo e tente novamente, caso aconteça novamente entre em contato com a equipe de suporte atraves do site do evento';

						return redirect('autor/trabalhos/listar?msg_erro='.$msg_erro);
					}

					return 'sucesso';
				}else{

					$msg_erro = 'O tamanho do arquivo excede o limite de 2 MB';

					return redirect('autor/trabalhos/listar?msg_erro='.$msg_erro);
				}

			}else{
				$msg_erro = 'Tipo de arquivo não suportado, verifique se o arquivo é do tipo PDF e tente novamente';

				return redirect('autor/trabalhos/listar?msg_erro='.$msg_erro);
			}

		}else{
			$msg_erro = 'O tamanho do arquivo excede o limite de 2 MB';

			return redirect('autor/trabalhos/listar?msg_erro='.$msg_erro);

		}
		
	}

	
}
