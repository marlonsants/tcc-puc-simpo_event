function ModalDetPessoa(id){


	$(document).on('click',"#detalhesDaPessoa", function(){
				
		var pessoa_id = $(this).attr('pessoa_id');
		
		$('#ModalHead').html('');
		$('#body').html('');
		$('.modal-title').html('');
		$('.modal-title').append('informações Pessoais');
		$('#ModalHead').append('<tr><th>Nome</th> <th>Sobrenome</th> <th>Email</th> <th>Instituição</th> <th>Título</th> <th>Cidade</th> <th>Estado</th> <th>Pais</th> <th>Celular</th> <th>Telefone</th><th>Documento</th><th>Número</th></tr>');
				
		$.get('/administrador/buscaPessoa/'+pessoa_id, function(pessoa){
			console.log(pessoa);
			// verifica se a consulta retornou dado
			if(pessoa != ''){
				info = '';				
				$.each( pessoa, function( key, value ) { //faz um each no objeto retornado
					info += '<tr>';

						$.each( value, function( indice, valor ) { //faz um each nos arrays contidos no objeto e garava eles nas linhas da tabela  
							if(indice == 'id'){
							return;
							}

							info+='<td>'+valor+'</td>';
						});

					info+='</tr>';	
				});
				
				console. log(info);
				$('#body').append(info); //imprime as informações no modal
			}
		});	

		$('#'+id).modal('show'); //abre o modal
	});

}


function ModalTrabalhosDoAutor(id){


	$(document).on('click',"#trabalhosDoAutor", function(){
		
		
		var pessoa_id = $(this).attr('pessoa_id');
		

		$('#ModalHead').html('');
		$('#body').html('');
		$('.modal-title').html('');
		$('.modal-title').append('Trabalhos do autor')
		$('#ModalHead').append('<tr><th>Titulo</th><th>Area</th> <th>categoria</th><th>Status</th><th>Acão</th>');
			
		$.get('/administrador/autores/trabalhos/'+pessoa_id, function(trabalhos){
			// verifica se a consulta retornou dado
			if(trabalhos != ''){
				info = '';				
				$.each( trabalhos, function( key, value ) { //faz um each no objeto retornado
					info += '<tr>';

						$.each( value, function( indice, valor ) { //faz um each nos arrays contidos no objeto e garava eles nas linhas da tabela  
							if(indice == 'id' || indice == 'status_id' || indice == 'parecer' || indice == 'decoration'){
							return;
							}
							info+='<td>'+valor+'</td>';
						});
					info+='<td><a href="/autor/trabalhos/visualizar/'+value.id+'" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" target="_blank" title= "PDF do Trabalho"><span class="glyphicon glyphicon-download-alt"/></a></td>';	
					info+='</tr>';	
				});
				
				console. log(info);
				$('#body').append(info); //imprime as informações no modal
			}
		});	

		$('#'+id).modal('show'); //abre o modal
	});

}
// fim da função 

function modalAutoresDoTrabalho(id){


	$(document).on('click',"#AutoresDoTrabalho", function(){
		
		var trabalho_id = $(this).attr('trabalho_id');
		

		$('#ModalHead').html('');
		$('#body').html('');
		$('.modal-title').html('');
		$('.modal-title').append('Autores do trabalho');
		$('#ModalHead').append('<tr><th>Nome Completo</th> <th>Email</th> <th>Instituição</th> <th>Título</th> <th>Cidade</th> <th>Estado</th> <th>Pais</th> <th>Celular</th> <th>Telefone</th><th>Documento</th><th>Número</th><th>Autoria</th></tr>');
				
		$.get('/administrador/buscaAutores/'+trabalho_id, function(autores){
			// verifica se a consulta retornou dado
			if(autores != ''){
				info = '';				
				$.each( autores, function( key, value ) { //faz um each no objeto retornado
					info += '<tr>';

						$.each( value, function( indice, valor ) { //faz um each nos arrays contidos no objeto e garava eles nas linhas da tabela  
							if(indice == 'id' || indice == 'autor_id'){
							return;
							}

							if (indice == 'nome') {info+= '<td>'+valor+' ';} //unir nome ao sobrenome
							else if (indice == 'sobrenome') {info+= valor+'</td>';} //unir nome ao sobrenome 

							else{info+='<td>'+valor+'</td>';}
						});

					info+='</tr>';	
				});
				
				console. log(info);
				$('#body').append(info); //imprime as informações no modal
			}
		});	

		$('#'+id).modal('show'); //abre o modal
	});

}


// inicio da função

function modalResumoDoTrabalho(id){


	$(document).on('click',"#resumoDoTrabalho", function(){
		
		var trabalho_id = $(this).attr('trabalho_id');
		

		$('#ModalHead').html('');
		$('#body').html('');
		$('.modal-title').html('');
		$('.modal-title').append('Resumo do trabalho');
		
		
		$.get('/administrador/trabalho/resumo/'+trabalho_id, function(trabalhos){
			// verifica se a consulta retornou dado
			console.log(trabalhos.resumo[0].resumo);
			var info = '';
			if(trabalhos.autores[0].nome != ''){
			info += '<div class"row">'+
							'<div class="col-md-12 " style="padding: 10px; text-align:center;"  >'+
							'<h4>Autor(es)</h4>';
								$.each(trabalhos.autores, function(key,value){
								info+='<h5>'+value.nome.toUpperCase()+' '+value.sobrenome.toUpperCase()+'</h5>';
								});
								
			info+=			'</div>'+
						'</div>';
			}			

			if(trabalhos.resumo[0].resumo != ''){
				info += '<div class"row">'+
							'<div class="col-md-12" style="padding: 10px; text-align: left;"  >'+
							'<h4>Resumo</h4>'+
								'<h5>'+trabalhos.resumo[0].resumo+'</h5>'+
								'<h4>Palavras chaves</h4>'+
								'<h5>'+trabalhos.resumo[0].palavra_chave+'</h5>'+
							'</div>'+
						'</div>'+
						
						'<div class"row">'+
							'<div class="col-md-12" style="padding: 10px; text-align: left;" >'+
								'<h4>Abstract</h4>'+
								'<h5>'+trabalhos.resumo[0].abstract+'</h5>'+
								'<h4>Key words</h4>'+
								'<h5>'+trabalhos.resumo[0].key_word+'</h5>'+
							'</div>'+
						'</div>';
								
				$('#body').append(info); //imprime as informações no modal
			}
		});	

		$('#'+id).modal('show'); //abre o modal
	});

}

function modalEditPdf(){
	$(document).on('click','.subPdf',function(){
		var trabalho_id = $(this).attr('trabalho_id');
		$('#inputSubPdf').val(trabalho_id);

		$('#modal_pdf').modal('show');	
	});
}

function modalAvaliarTrabalho(){
	$(document).on('click','.avaliar',function(){

		var acao = $(this).attr('acao');
		var trabalho_id = $(this).attr('trabalho_id');
		$('#ModalHead').html('');
		$('#body-avaliar').html('');
		$('.title-avaliar').html('');
		$('.footer-avaliar').html('');
		$('.title-avaliar').append('Atenção !');

		if(acao == 'aprovar'){
			$('#body-avaliar').append('<h4>Deseja aprovar o trabalho ?</h4>');
			$('.footer-avaliar').prepend('<a href="/administrador/trabalho/aprovar/'+trabalho_id+'" acao="aprovar" class="btn btn-success avaliar" data-toggle="tooltip" data-placement="left" title="aprovar o trabalho">Sim</a><button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>');
		}else{
			$('#body-avaliar').append('<h4>Deseja reprovar o trabalho ?</h4>');
			$('.footer-avaliar').prepend('<a href="/administrador/trabalho/reprovar/'+trabalho_id+'" acao="reprovar" class="btn btn-success avaliar" data-toggle="tooltip" data-placement="left" title="reprovar o trabalho">Sim</a><button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>');
		}
		

		$('#modal_avaliar').modal('show');	
	});
}


	$(document).on('click','#NotasCriterios', function(){
		var trabalho_id = $(this).attr('trabalho_id');
		$('#notas_criterios').html(' ');
		
		$.get('/administrador/criterios/notas/'+trabalho_id, function(avaliacoes){
			var linha = '';
			console.log(avaliacoes);
			$.each(avaliacoes, function(key,val){
				if(val != $(avaliacoes).get(-1)){	
					linha+=	'<br>'+
							'<h4 class="text" style="font-weight: bold">Notas do avaliador '+(key+1)+' </h4>'+
							'<br>'+
								'<table class="table table-bordered table-condensed table-striped">'+
									'<thead style="font-weight: bold; font-size: 20px">'+
									'<th>Criterio</th>'+
									'<th>Descrição</th>'+
									'<th>Peso</th>'+
									'<th>Nota</th>'+
									'</thead>'+
									'<tbody>';
										$.each(val, function (indice,criterio){
										if(criterio != $(val).get(-1)){	
					linha+=					'<tr>'+
												'<td>'+(indice+1)+'</td>'+
												'<td>'+criterio['nome']+'</td>'+
												'<td>'+criterio['peso']+'</td>'+
												'<td>'+criterio['nota']+'</td>'+
											'</tr>';
										}
										});
					linha+=			'</tbody>'+
								'</table><br>';
				}			
				
			});
		$('#notas_criterios').append(linha);		
		});	
		
		$('#modal_criterios').modal('show');
	});
	
