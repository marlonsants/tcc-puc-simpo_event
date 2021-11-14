@extends(session('acesso_id') === 1 ? '/usuarios/autores/header' : '/usuarios/avaliadores/header')
<?php 
use App\Model\Evento;

	$maxAutores = Evento::maxAutores();

 ?>
@push('mask')
<script type="text/javascript" src="/js/mask/jquery.mask.js"></script>
@endpush

@section('conteudo') 
<div class="row">

	@if(Session::has('msg'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('msg')}}</b></p></div>
	@endif	
	@if(Session::has('erro'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('erro')}}</b></p></div>
	@endif	

	<div class="container-fluid col-xs-12 col-md-10 col-md-offset-1">
		@if(isset($trabalho))
		<h2>Editar trabalho</h2>
		<form action="{{url('autor/trabalhos/editarTrabalho',$trabalho->id)}}" method="POST" accept-charset="utf-8" class="form-group" 
		oninput="texto = resumo.value.substr(0, 2500);resumo.value.length <= 2500 ? qr.value = resumo.value.length : qrm.value ='Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto';  resumo.value=texto;  
		textoT = titulo.value.substr(0, 200);titulo.value.length <= 200 ? qt.value = titulo.value.length : qtm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; titulo.value=textoT;  
		textoP = palavra_chave.value.substr(0, 200);palavra_chave.value.length <= 200 ? qp.value = palavra_chave.value.length : qpm.value='Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; palavra_chave.value=textoP;   
		textoA = abstract.value.substr(0, 2500);abstract.value.length <= 2500 ? qa.value = abstract.value.length : qam.value = 'Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; abstract.value=textoA;    
		textoK = key_word.value.substr(0, 200);key_word.value.length <= 200 ? qk.value = key_word.value.length : qkm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; key_word.value=textoK; ">	
		{!!method_field('PUT')!!}	
		@else
		<h2>Cadastrar trabalho</h2>
		<form action="{{url('autor/cadastrar/trabalho')}}" method="POST" accept-charset="utf-8" class="form-group" 
		oninput="texto = resumo.value.substr(0, 2500);resumo.value.length <= 2500 ? qr.value = resumo.value.length : qrm.value ='Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto';  resumo.value=texto;  
		textoT = titulo.value.substr(0, 200);titulo.value.length <= 200 ? qt.value = titulo.value.length : qtm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; titulo.value=textoT;  
		textoP = palavra_chave.value.substr(0, 200);palavra_chave.value.length <= 200 ? qp.value = palavra_chave.value.length : qpm.value='Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; palavra_chave.value=textoP;   
		textoA = abstract.value.substr(0, 2500);abstract.value.length <= 2500 ? qa.value = abstract.value.length : qam.value = 'Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; abstract.value=textoA;    
		textoK = key_word.value.substr(0, 200);key_word.value.length <= 200 ? qk.value = key_word.value.length : qkm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; key_word.value=textoK; ">
		@endif
		
			{!!csrf_field()!!}
			<div id="Autores">
				<input type="hidden" id="AutorLogado" value="{{Session('id')}}" >
				@if(isset($autores))

					@foreach($autores as $autor)
						<div id="divAutor{{$autor->id}}">
							<input id="idAutor{{$autor->id}}" class="idAutor" type="hidden"  name="autores[autor{{$autor->id}}][id]" value="{{$autor->id}}">
							<input id="ordemAutor{{$autor->id}}" class="ordemAutor" type="hidden"  name="autores[autor{{$autor->id}}][ordem]" value="{{$autor->ordemDeAutoria}}">
							<input id="AutorId{{$autor->id}}" class="autor_id" type="hidden"  name="autores[autor{{$autor->id}}][autor_id]" value="{{$autor->autor_id}}">
						</div>				
					@endforeach
							
				@else 
					<div id="divAutor{{Session('id')}}">
						<input id="idAutor{{Session('id')}}" class="idAutor" type="hidden"  name="autores[autor{{Session('id')}}][id]" value="{{Session('id')}}">
						<input id="ordemAutor{{Session('id')}}" class="ordemAutor" type="hidden"  name="autores[autor{{Session('id')}}][ordem]" value="1">
					</div>			
				@endif

				
				
			</div>
						
			<div class="row">
				<div class="col-xs-12 col-md-12 form-group">
					<label>Título</label>
					<output class="text-danger" name="qtm"></output>
					<input required type="tex" name="titulo"  class="form-control" placeholder="Título do Artigo" value="{{ $trabalho->titulo or old('titulo')}}" style="text-align: left;">
					<output name="qt">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-6 form-group">
					<label>Resumo</label>
					<output name="qrm" class="text-danger"></output>
					<textarea required name="resumo" class="form-control"  placeholder="Resumo do Artigo" style="width: 100%; height: 20%;">{{ $trabalho->resumo or old('resumo')  }}</textarea>
					<output name="qr">0</output>
				</div>

				<div class="col-xs-12 col-md-6 form-group">
					<label>Abstract</label>
					<output name="qam" class="text-danger"></output>
					<textarea required name="abstract" class="form-control" placeholder="Abstract" style="width: 100%; height: 20%;">{{ $trabalho->abstract or old('abstract') }}</textarea>
					<output name="qa">0</output>
				</div>
			
				
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-6 form-group">
					<label>Palavras-chaves</label>
					<output name="qpm" class="text-danger"></output>
					<textarea required name="palavra_chave" class="form-control"  placeholder="Palavras-chave" style="width: 100%;">{{ $trabalho->palavra_chave or old('palavra_chave')}}</textarea>
					<output name="qp">0</output>
				</div>
			
				<div class="col-xs-12 col-md-6 form-group">
					<label>Key Words</label>
					<output name="qkm" class="text-danger"></output>
					<textarea required name="key_word" class="form-control"   placeholder="Key-words" style="width: 100%;">{{ $trabalho->key_word or old('key_word')}}</textarea>
					<output name="qk">0</output>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-4 form-group">
					<label>Categoria</label>
					<select name="categoria_id"  class="form-control" required>
						@if(isset($trabalho))
							<option selected value="{{$trabalho->categoria_id}}">{{$trabalho->categoria}}</option>
						@endif
						@forelse($categoria as $categorias)
						<option value="{{$categorias->id }} ">{{$categorias['nome'] }}</option>
						@empty
						<option></option>
						@endforelse
					</select>
				</div>

				<div class="col-xs-12 col-md-4 form-group">
					<label>Area</label>
					<select name="area_id"  class="form-control" required>
						@if(isset($trabalho))
							<option selected value="{{$trabalho->area_id}}">{{$trabalho->area}}</option>
						@endif
						@forelse($area as $areas)
						<option value="{{$areas->id}}">{{$areas['nome']}}</option>
						@empty
						<option></option>
						@endforelse
					</select>
				</div>


				{{-- <div class="col-xs-12 col-md-4 form-group">
					<label>Coator(es)</label>
					<select name="coautores" id="coautores"  class="form-control">
						@for($i = 0; $i < $maxAutores; $i++)
							@if($i == 0)
								<option value="{{$i}}">Não possui Coautores</option>
							@elseif($i == 1)
								<option value="{{$i}}">{{$i}} Coautor</option>
							@else
								<option value="{{$i}}">{{$i}} Coautores</option>
							@endif
						@endfor
					</select>
				</div> --}}

				
				<div id="coautoresdiv"></div>
				<!-- modal de aviso quando o coautor não está cadastrado -->
				<div id="modalMensagem" class="modal fade" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Atenção !</h4>
				      </div>
				      <div class="modal-body">
				      	<p>
				      		O coautor informado não está cadastrado no sistema !!!!!
				      	</p>
				       <p>
						Para ser coautor de um trabalho é necessário estar cadastrado no sistema, pois as informações para os anais do evento serão coletadas a partir do cadastro.
						</p>
						<p>
						Agradecemos a compreessão qualquer dúvida favor entrar em contato através do e-mail 
						<strong>system4college@gmail.com</strong>
						</p>	
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				       </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- fim do modal -->

				
			</div>

			<div class="row">
				<div class="col-md-12">
					<label>Autores do trabalho</label> <button  type="button" data-toggle="modal" data-target="#ModalAutores" class="btn-sm btn-info glyphicon glyphicon-plus" tool></button>	
					

					<table class="table">
						<thead style="background-color: white; color: black; font-size: 14px "> 
							<th>Nome</th><th>email</th><th>Ordem de autoria</th><th></th>
						</thead>
						@if(isset($autores))

							@foreach( $autores as $autor)
								<tbody style="font-size: 14px" id="tabelaDeAutores">
									<tr id="trAutor{{$autor->id}}">
										<td>{{$autor->nome}}</td><td>{{$autor->email}}</td><td>{{$autor->ordemDeAutoria}}º Autor(a)</td>
										<td>
											<button id="{{$autor->id}}" email="{{$autor->email}}" nome="{{$autor->nome}}" ordem="{{$autor->ordemDeAutoria}}" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> 
											@if($autor->id != session('id'))
											<button id="{{$autor->id}}" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button> 
											@endif
										</td>	
									</tr>
							
								</tbody>
							@endforeach
							
						@else 
							<tbody style="font-size: 14px" id="tabelaDeAutores">
								<tr id="trAutor{{session('id')}}">
									<td>{{Session('pessoa_nome')}}</td><td>{{Session('email')}}</td><td>1º Autor(a)</td>
									<td>
										<button id="{{session('id')}}" email="{{Session('email')}}" nome="{{Session('pessoa_nome')}}" ordem="1" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> 
									</td>	
								</tr>
							
							</tbody>
						@endif
						
						

					</table>

				</div>
				
			</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
					<input type="submit" value="Salvar" class="form-control btn btn-info" >
				</div>		
			</div>
					

		</form>
	</div>

	<div id="ModalAutores" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			       <h4 class="modal-title">Incluir Autor !</h4>
			    </div>

			    <div class="modal-body">
			    	<input type="hidden" id="idAutor" name="idAutor" class="form-control email" >
			      	<div class="col-md-4 coautores">
			      		<input placeholder="E-mail " type="text" id="email" name="email" class="form-control email" required>
					</div>

					<div class="col-md-4" name="NomeCoautor">
						<input placeholder="nome " type="text" id="nome" name="nome" class="form-control"  readonly  required>
					</div>

					<div class="col-md-4" name="OrdemDeAutoria">

						<Select id="OrdemDeAutoria" name="OrdemDeAutoria" class="form-control"   required>
							<option value="0">Ordem de autoria</option>
							@for ($x = 1; $x <= $maxAutores; $x++)
								<option value="{{$x}}">{{$x}}º Autor(a)</option>
							@endfor
						</select>
			      	</div>
			    </div>	
		      <div class="modal-footer">
		      	<button class="btn btn-info" id="SalvarAutor"> Salvar</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		       </div>
		    </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	
	</div>

@if(old())
	<script type="text/javascript">
		$('#modalMensagem').modal('show');
	</script>
@endif

<script type="text/javascript">
	
	criaFormCoautores();
	buscaCoautor();

	$('#ModalAutores').on('hidden.bs.modal', function(){ 
		console.log("entrou no toogle")
		$('#email').text('');
		$('#email').val('');
		$('#email').attr('placeholder','E-mail');
		$('#email').css("border-color","#ccc");
		$('#nome').text('');
		$('#nome').val('');
	});

	// Função onClick acionada ao clicar no botão para salvar no modal de inclusão de novo autor
	$('#SalvarAutor').on('click', function(){ 
		var id = $('#idAutor').val();
		var nome = $('#nome').val();
		var email = $('#email').val();
		var ordem = $('#OrdemDeAutoria option:selected').val();
		var OrdemHeIgual = false;
		var AutorJaCadastrado = false;
		var IdAutorLogado = $('#AutorLogado').val();

		if(ordem == 0){
			alert('Selecione a ordem de autoria !');
		}

		$('.ordemAutor').each(function(key,val){
			if ( $(this).val() == ordem){

				alert('A ordem de autoria selecionada já foi atribuida a outro autor, verifique a lista de autores do trabalho !');
				OrdemHeIgual = true;
			}
		});

		$('.idAutor').each(function(key,val){
			if ( $(this).val() == id){

				AutorJaCadastrado = true;
			}
		});

		if(OrdemHeIgual == false && ordem != 0){
			// caso o autor já esteja cadastrado só altera as informações
			if(AutorJaCadastrado == true){
				$('#idAutor'+id+'').remove();
				$('#ordemAutor'+id+'').remove();
				// Edita os input com os dados do autor
				var autor = '<input id="idAutor'+id+'" class="idAutor" type="hidden"  name="autores[autor'+id+'][id]" value="'+id+'">'+
							'<input id="ordemAutor'+id+'" class="ordemAutor" type="hidden"  name="autores[autor'+id+'][ordem]" value="'+ordem+'">';

				$('#divAutor'+id+'').append(autor);

				// Edita a tabela que lista os autores
				$('#trAutor'+id+'').html(' ');
				var tr	= 	'<td>'+nome+'</td><td>'+email+'</td><td>'+ordem+'º Autor(a)</td>'+
							'<td><button id="'+id+'" email="'+email+'" nome="'+nome+'" ordem="'+ordem+'" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> ';
				if(IdAutorLogado != id){
					tr +=	'<button id="'+id+'" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button></td>';	
				}		
					
							
				$('#trAutor'+id+'').append(tr);

			}else{
				// insere o input com os dados do autor
				var autor = '<div id="divAutor'+id+'">'+
							'<input id="idAutor'+id+'" class="idAutor" type="hidden"  name="autores[autor'+id+'][id]" value="'+id+'">'+
							'<input id="ordemAutor'+id+'" class="ordemAutor" type="hidden"  name="autores[autor'+id+'][ordem]" value="'+ordem+'">'+	
						'</div>';
				$('#Autores').append(autor);	

				// insere a linha na tabela com os dados do autor
				var tr	= 	'<tr id="trAutor'+id+'">'+
								'<td>'+nome+'</td><td>'+email+'</td><td>'+ordem+'º Autor(a)</td>'+
								'<td><button id="'+id+'" email="'+email+'" nome="'+nome+'" ordem="'+ordem+'" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> '+
								'<button id="'+id+'" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button></td>'+	
							'</tr>';
				$('#tabelaDeAutores').append(tr);			
			}

			$('#ModalAutores').modal('hide');
						
		}
	});

	// Editar Autor 
	$(document).on('click','.editarAutor',function(){ 
		var id = $(this).attr('id');
		var email = $(this).attr('email');
		var nome = $(this).attr('nome');
		
		$('#idAutor').val(id);
		$('#email').val(email);
		$('#nome').val(nome);

		$('#ModalAutores').modal('show');

	});

	// Excluir autor
	$(document).on('click','.excluirAutor',function(){ 
		console.log('entrou na função excluir');
		var id = $(this).attr('id');
		$('#trAutor'+id+'').remove();
		$('#idAutor'+id+'').remove();
		$('#ordemAutor'+id+'').remove();
	
	});	

</script>

@stop
<style type="text/css" media="screen">
	input{
		text-align: center;
	}
</style>

