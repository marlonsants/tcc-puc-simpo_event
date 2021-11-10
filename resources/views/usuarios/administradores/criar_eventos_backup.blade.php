@extends('/usuarios/administradores/header')

@section("conteudo")
<div class="row">
	<div class="col-md-12">
	@if(Session::has('msg'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('msg')}}</b></p></div>
	@endif	
	@if(Session::has('erro'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('erro')}}</b></p></div>
	@endif	
		<h3 class="text-center  text-info">Informações do Evento </h3>
		<hr>
		 @if(isset($evento))
		    <form action="{{url('administrador/editar/evento', $evento->id)}}" method="POST" accept-charset="utf-8">
		    {!!method_field('PUT')!!}
	    @else
		<form action="/administrador/eventos/novo/cadastrar" method="post" accept-charset="utf-8" class="form-group">
		@endif	
			{!!csrf_field()!!}
			
			<div class="col-md-12">

				<div class="row">
					
					<div class="col-md-4">
						<label>Nome do evento</label>
						<input type="text" value="{{$evento->nome_evento or old('nome_evento')}}" name="nome_evento" placeholder="Nome do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Instituição</label>
						<input type="text" value="{{$evento->instituicao or old('instituicao')}}" name="instituicao" placeholder="Instituição do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Endereço de realização</label>
						<input type="text" value="{{$evento->local_evento or old('local_evento')}}" name="local_evento" placeholder="Endereço completo do Evento" class="form-control">
					</div>
				</div>

				<div class="row">	
					<div class="col-md-12">	
						<label>Tema</label>		
						<textarea name="tema" placeholder="Tema do Evento" class="form-control" rows="5">{{$evento->tema or old('tema')}}</textarea>
					</div>
				</div>

			</div>

			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info ">Regras</h3>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<label>Máximo de trabalhos por autor</label>
						<input type="number" value="{{$evento->num_trab_autor or old('num_trab_autor')}}" name="num_trab_autor" placeholder="Máximo de Trabalhos por Autor" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de autores por trabalho</label>
						<input type="number" value="{{$evento->max_autores or old('max_autores')}}" name="max_autores" placeholder="Máximo de autores por Trabalho" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de trabalhos por avaliador</label>
						<input type="number" value="{{$evento->num_trab_avaliador or old('num_trab_avaliador')}}" name="num_trab_avaliador" placeholder="Máximo de trabalhos por Avaliador" class="form-control">
					</div>

					<div class="col-md-6">
						<label>Máximo de avaliadores por trabalho</label>
						<input type="number" value="{{$evento->max_avaliadores_trabalhos or old('max_avaliadores_trabalhos')}}" name="max_avaliadores_trabalhos" placeholder="Máximo de avaliadores por trabalho" class="form-control">
					</div>
					<div class="col-md-6">
						<label>Nota maxima do trabalho</label>
						<input value="{{$evento->max_nota_trabalhos or old('max_nota_trabalhos')}}" type="number" name="max_nota_trabalhos" placeholder="Nota maxima do trabalho" class="form-control">
					</div>				
				</div>
			</div>


			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info">Datas</h3>
				<hr>
				<p id="mgsData"  class="text-bold text-center"><b ></b></p>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Submissões</label>
						<input type="date" value="{{$evento->inicio_submissao or old('inicio_submissao')}}" name="inicio_submissao" id="inicio_submissao" placeholder="Início das Submissões" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Fim das Submissões</label>
						<input type="date" value="{{$evento->fim_submissao or old('fim_submissao')}}" name="fim_submissao" id="fim_submissao" placeholder="Fim das Submissões" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Início das Avaliações</label>
						<input type="date" value="{{$evento->inicio_avaliacoes or old('inicio_avaliacoes')}}" name="inicio_avaliacoes" id="inicio_avaliacoes" placeholder="Início das Avaliações" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Fim das Avaliações</label>
						<input type="date" value="{{$evento->fim_avaliacoes or old('fim_avaliacoes')}}" name="fim_avaliacoes" id="fim_avaliacoes" placeholder="Fim das Avaliações" class="datas-evento form-control" required>
					</div>					
				</div>
			</div>

			<div class="col-md-12 margin-top-20">
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Incrições</label>
						<input type="date" value="{{$evento->inicio_inscricoes or old('inicio_inscricoes')}}" name="inicio_inscricoes" id="inicio_inscricoes" placeholder="Início das Incrições" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Fim das Incrições</label>
						<input type="date" value="{{$evento->fim_inscricoes or old('fim_inscricoes')}}" name="fim_inscricoes" id="fim_inscricoes" placeholder="Fim das Incrições" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Início do Evento</label>
						<input type="date" value="{{$evento->inicio_evento or old('inicio_evento')}}" name="inicio_evento" id="inicio_evento" placeholder="Início do Evento" class="datas-evento form-control" required>
					</div>
					<div class="col-md-3">
						<label for="">Fim do Evento</label>
						<input type="date" value="{{$evento->fim_evento or old('fim_evento')}}" name="fim_evento" id="fim_evento" placeholder="Fim do Evento" class="datas-evento form-control" required>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-md-offset-3 margin-top-20">
				<input type="submit" name="cadastrar" class="btn btn-info form-control" value="Cadastrar">	
			</div>
		</form>
	</div>
</div><br>

<script type="text/javascript">
  $('#novoevento').addClass('active');

		// verifica a data de início das submissões de trabalhos
	  $(document).on('change','#inicio_submissao',function(){
	  	
	  	var dataAlterada = $(this).val();
	  	console.log('dataAlterada inicio da submissão = '+dataAlterada);
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada >= fim_submissao && fim_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da submissão não pode ser maior ou igual a data de fim da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da submissão não pode ser maior ou igual a data de inicio das avaliações dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_avaliacoes && fim_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da submissão não pode ser maior ou igual a data de fim das avaliações dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da submissão não pode ser maior ou igual a data de inicio das inscrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da submissão não pode ser maior ou igual a data de fim das inscrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  		if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de início da submissão não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de início da submissão não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  	
	  	
	  });
  		// verifica a data de fim das submissões de trabalhos
	  $(document).on('change','#fim_submissao',function(){
	  	
	  	var dataAlterada = $(this).val();
	  	console.log('dataAlterada fim da submissão = '+dataAlterada);
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_avaliacoes && fim_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de fim da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da submissão não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  });

	  $(document).on('change','#inicio_avaliacoes',function(){
	  	
	  	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= fim_submissao){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser menor ou igual a data de fim da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada >= fim_avaliacoes && fim_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser maior ou igual a data de fim da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser maior ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser maior ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da avaliação não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  });
	  	// verifica a data de fim das avaliações de trabalhos
	  $(document).on('change','#fim_avaliacoes',function(){
	  	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser menor ou igual a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada >= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser maior ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser maior ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da avaliação não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  });
	  	// verifica a data de inicio das inscrições
	  $(document).on('change','#inicio_inscricoes',function(){
	  	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da inscrição não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da inscrição não pode ser menor ou igual a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  		  	
	  	if(dataAlterada >= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' '); 
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da inscrição não pode ser maior ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da inscrição não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio da inscrição não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  });
	  	// verifica a data de fim das inscrições
	  $(document).on('change','#fim_inscricoes',function(){
	  	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da inscrição não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da inscrição não pode ser menor ou igual do que a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada <= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da inscrição não pode ser menor ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada >= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da inscrição não pode ser maior ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim da inscrição não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  });
	  	// verifica a data de inicio do evento
	  $(document).on('change','#inicio_evento',function(){
	  	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio do evento não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio do evento não pode ser menor ou igual do que a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada <= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio do evento não pode ser menor ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio do evento não pode ser menor ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada >= fim_evento && fim_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de inicio do evento não pode ser maior ou igual a data de fim do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}
	  });
	  	// verifica a data de fim do evento
	   $(document).on('change','#fim_evento',function(){
	   	var dataAlterada = $(this).val();
	  	var fim_submissao = $('#fim_submissao').val();
	  	var inicio_avaliacoes = $('#inicio_avaliacoes').val();
		var fim_avaliacoes = $('#fim_avaliacoes').val();
		var inicio_inscricoes = $('#inicio_inscricoes').val();
		var fim_inscricoes = $('#fim_inscricoes').val();
		var inicio_evento = $('#inicio_evento').val();
		var fim_evento = $('#fim_evento').val();

	  	if(dataAlterada <= inicio_submissao && inicio_submissao != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim do evento não pode ser menor ou igual a data de início da submissão dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_avaliacoes && inicio_avaliacoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim do evento não pode ser menor ou igual do que a data de início da avaliação dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	
	  	if(dataAlterada <= inicio_inscricoes && inicio_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim do evento não pode ser menor ou igual a data de início das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= fim_inscricoes && fim_inscricoes != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim do evento não pode ser menor ou igual a data de fim das incrições dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  	if(dataAlterada <= inicio_evento && inicio_evento != ''){
	  		$('#mgsData').html(' ');
	  		$('#mgsData').append('<b class="alert alert-danger">A data de fim do evento não pode ser menor ou igual a data de início do evento dataAlterada = '+dataAlterada+'</b>');	
		  	$(this).val(' ');
		  	return false;
	  	}

	  
	  });
 
</script>

@stop 