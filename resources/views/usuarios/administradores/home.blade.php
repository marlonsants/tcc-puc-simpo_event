
@extends('/usuarios/administradores/header')

@section("conteudo")
<div class="row">
	<div class="col-md-8 col-md-offset-2 box-login">	
		<div class="text-center">
			<h3>Antes de começar selecione um de seus eventos cadastrados.</h3>
			<form action="/administrador/escolherevento" method="post" accept-charset="utf-8" class="form-group">
			{!!csrf_field()!!}
				<select name="evento_id" class="form-control">
					@if(isset($eventos) and count($eventos) > 0)
					@foreach($eventos as $evento)					
					<option value="{{$evento->id}}">{{$evento->nome_evento}} - {{$evento->tema}}</option>}}
					@endforeach
					@else
					<option value="0">Não existe Eventos Cadastrados</option>	
					@endif
				</select>		
				<input type="submit" name="escolher" value="Escolher Evento" class="btn btn-info form-control">
			</form>
		</div>

	</div>
<script type="text/javascript">
  $('#selecionaevento').addClass('active');
</script>
</div>
@stop 
