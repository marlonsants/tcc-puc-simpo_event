@extends('/usuarios/administradores/header')

@section("conteudo")
<div class="row">
	<h3 class="text-center text-info">Eventos</h3><hr>
	@if(Session::has('msg'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('msg')}}</b></p></div>
	@endif	
	@if(Session::has('erro'))
	<div class="alert alert-success text-center"><p><b>{{Session::get('erro')}}</b></p></div>
	@endif	
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-2 col-xs-12">
        <a class="btn btn-block btn-primary" href="/administrador/eventos/novo">
            Novo Evento <span class="glyphicon glyphicon-plus"></span>
         </a>
    </div>    
</div>
<br>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		@if(count($eventos)>0)
		<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th>Nome</th>
                    <th>Status</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($eventos as $evento)
				<tr>
					<td>{{$evento->nome_evento}}</td>
                    @if($evento->visible)
                        <td class="text-primary">
                            <strong>Ativo</strong>
                        </td>
                    @else
                        <td class="text-danger">
                            <strong> Inativo</strong>
                        </td>
                    @endif
					<td>
						<a title="Editar" class="btn btn-sm btn-info" href="/administrador/editarEvento/{{$evento->id}}" ><span class="glyphicon glyphicon-pencil"></span></a>
                        @if($evento->visible) 
                        <a title="Inativar" class="btn btn-sm btn-danger" href="/administrador/evento/inativar/{{$evento->id}}" ><span class="glyphicon glyphicon-remove"></span></a>
                        @else
                        <a title="Ativar" class="btn btn-sm btn-primary" href="/administrador/evento/inativar/{{$evento->id}}" ><span class="glyphicon glyphicon-ok"></span></a>
                        @endif

                        <form action="/administrador/escolherevento" method="post" accept-charset="utf-8" style="display:inline;">
							{!!csrf_field()!!}
							<input type="hidden" name="evento_id" value="{{$evento->id}}">
							<button title="Acessar evento" class="btn btn-sm btn-success" type="submit"><span class="glyphicon glyphicon-log-in"></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<alert class="alert alert-info col-md-12 text-center">Nenhum evento cadastrado até o momento</alert>
		@endif
        
	</div>
</div>

<script type="text/javascript">
	
</script>
@stop  
