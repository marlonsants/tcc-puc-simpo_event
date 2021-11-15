
@extends('/usuarios/administradores/header')

@section("conteudo")
@push('scripts')
    <script src="/js/uploadLogo.js"></script>
@endpush
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
		    <form id="formEvento" action="{{url('administrador/editar/evento', $evento->id)}}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		    {!!method_field('PUT')!!}
	    @else
		<form id="formEvento" action="/administrador/eventos/novo/cadastrar" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-group">
		@endif	
			{!!csrf_field()!!}
			
			<div class="col-md-12">

				<div class="row">
					
					<div class="col-md-4">
						<label>Nome do evento</label>
						<input required type="text" value="{{$evento->nome_evento or old('nome_evento')}}" name="nome_evento" placeholder="Nome do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Instituição</label>
						<input required type="text" value="{{$evento->instituicao or old('instituicao')}}" name="instituicao" placeholder="Instituição do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Endereço de realização</label>
						<input required type="text" value="{{$evento->local_evento or old('local_evento')}}" name="local_evento" placeholder="Endereço completo do Evento" class="form-control">
					</div>
				</div>

				<div class="row">	
					
					<div class="col-md-4">	
						<label>Logo do evento</label>
						<div class="panel panel-default">
							<div class="panel panel-body">
								@if(isset($evento->logo_id) && $evento->logo_id != null )
									<img id="imgLogoEvento" style=" min-width:150px; min-height:100px; max-width:150px; max-height:100px; width: auto; height: auto;" class="img-responsive"  src="{{asset('images/logoDosEventos/'.$evento->logo_id) }}" >
									{{-- {{asset('storage/app/public/logoDosEventos/'.$evento->logo_id) }}									 --}}
									{{-- {{asset('images')}}/logoDosEventos/{{$evento->logo_id}} --}}
									{{-- {{ public_path('images\logoDosEventos\\'.$evento->logo_id) }}" --}}
								
								@endif	
							</div>
							<div class="panel panel-footer" style="height: 50px">
								<input class="btn btn-info form-control" type="file" id="logoEvento"  name="logoEvento">		
							</div>
								
								
										
						</div>	
						
					</div>

					<div class="col-md-8">	
						<label>Tema</label>		
						<textarea style="min-height:150px; height: auto;" name="tema" placeholder="Tema do Evento" class="form-control" rows="5">{{$evento->tema or old('tema')}}</textarea>
					</div>

				</div>

			</div>

			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info ">Regras</h3>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<label>Máximo de trabalhos por autor</label>
						<input required type="number" value="{{$evento->num_trab_autor or old('num_trab_autor')}}" name="num_trab_autor" placeholder="Máximo de Trabalhos por Autor" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de autores por trabalho</label>
						<input required type="number" value="{{$evento->max_autores or old('max_autores')}}" name="max_autores" placeholder="Máximo de autores por Trabalho" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de trabalhos por avaliador</label>
						<input required type="number" value="{{$evento->num_trab_avaliador or old('num_trab_avaliador')}}" name="num_trab_avaliador" placeholder="Máximo de trabalhos por Avaliador" class="form-control">
					</div>

					<div class="col-md-6">
						<label>Máximo de avaliadores por trabalho</label>
						<input required type="number" value="{{$evento->max_avaliadores_trabalhos or old('max_avaliadores_trabalhos')}}" name="max_avaliadores_trabalhos" placeholder="Máximo de avaliadores por trabalho" class="form-control">
					</div>
					<div class="col-md-6">
						<label>Nota maxima do trabalho</label>
						<input required value="{{$evento->max_nota_trabalhos or old('max_nota_trabalhos')}}" type="number" name="max_nota_trabalhos" placeholder="Nota maxima do trabalho" class="form-control">
					</div>				
				</div>
			</div>


			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info">Datas</h3>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Submissões</label>
						<input required type="date" value="{{$evento->inicio_submissao or old('inicio_submissao')}}" name="inicio_submissao" placeholder="Início das Submissões" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Submissões</label>
						<input required type="date" value="{{$evento->fim_submissao or old('fim_submissao')}}" name="fim_submissao" placeholder="Fim das Submissões" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Início das Avaliações</label>
						<input required type="date" value="{{$evento->inicio_avaliacoes or old('inicio_avaliacoes')}}" name="inicio_avaliacoes" placeholder="Início das Avaliações" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Avaliações</label>
						<input required type="date" value="{{$evento->fim_avaliacoes or old('fim_avaliacoes')}}" name="fim_avaliacoes" placeholder="Fim das Avaliações" class="form-control">
					</div>					
				</div>
			</div>

			<div class="col-md-12 margin-top-20">
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Incrições</label>
						<input required type="date" value="{{$evento->inicio_inscricoes or old('inicio_inscricoes')}}" name="inicio_inscricoes" placeholder="Início das Incrições" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Incrições</label>
						<input required type="date" value="{{$evento->fim_inscricoes or old('fim_inscricoes')}}" name="fim_inscricoes" placeholder="Fim das Incrições" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Início do Evento</label>
						<input required type="date" value="{{$evento->inicio_evento or old('inicio_evento')}}" name="inicio_evento" placeholder="Início do Evento" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim do Evento</label>
						<input required type="date" value="{{$evento->fim_evento or old('fim_evento')}}" name="fim_evento" placeholder="Fim do Evento" class="form-control">
					</div>
				</div>
			</div>

			<div class="col-md-6 col-md-offset-3 margin-top-20">
				<input required type="submit" name="cadastrar" class="btn btn-info form-control" value="Cadastrar">	
			</div>
		</form>
	</div>
</div><br>

<script type="text/javascript">
  $('#novoevento').addClass('active');
//   $('#formEvento').submit(function(){
//   	window.location.reload(true);
//   });
  
  
</script>
@stop 