@extends('usuarios/header')

@section('conteudo')
<body class="body-cinza">

<div class="row">
	<div class="col-md-10 col-md-offset-1 box-login">
		<div class="panel panel-default panel-body borda-0px sombra">	
		<div class="text-center">
			<div class="row"><div class="legenda">Clique no evento que deseja acessar</div></div>
			<div class="col-md-12">
				@foreach($eventos as $evento)	
					<div class="col-md-3">  
						<div	class="panel panel-default" style="margin-left: 10px;margin-top:50px;">
							<div class="panel panel-body" style="padding: 10px; margin:0px,0px,0px,10px;height: 150px">
								<a href="/escolher_evento/{{$evento->id}}">
									<img class="img-thumbnail" style="display: block; margin-left: auto; margin-right: auto; height:150px" src="{{URL::asset('images')}}/logoDosEventos/{{$evento->logo_id}}"> 
								</a>		
							</div>	
							<div class="panel panel-footer" style="height: 30px">
								<a href="/escolher_evento/{{$evento->id}}" style="color: black">
									<strong>{{$evento->nome_evento}}</strong>
								</a>
							</div>
						 	
						</div>
					</div>	
				@endforeach
			</div>
			<!-- <form action="/escolher_evento" method="post" accept-charset="utf-8" class="form-group">
				{!!csrf_field()!!}
				<select class="form-control" name="evento_id">	
					@if(isset($eventos) and count($eventos) > 0)
					@foreach($eventos as $evento)					
					<option value="{{$evento->id}}">{{$evento->nome_evento}} - {{$evento->instituicao}}</option>}}
					@endforeach
					@else
					<option value="0">Não existe Eventos Cadastrados</option>	
					@endif
				</select>		
				<input type="submit" name="escolher" value="Escolher Evento" class="btn btn-info form-control">
			</form> -->
		</div>

	</div>
	<script type="text/javascript">
		$('#selecionaevento').addClass('active');
	</script>
</div>
@stop