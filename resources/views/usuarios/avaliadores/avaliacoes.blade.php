@extends("/usuarios/avaliadores/header")

@section('conteudo')

	@if(Session::has('msg'))
		<div class="alert alert-danger text-center"><p><b>{{Session::get('msg')}}</b></p></div>
	@endif

	@if(Session::has('suc'))
		<div class="alert alert-success text-center"><p><b>{{Session::get('suc')}}</b></p></div>
	@endif

<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
	<caption class="text-center">Listagem de Trabalhos</caption>
	<thead>
		<tr class="text-center">
			<th>Título</th>
			<th>Área</th>
			<th>Categoria</th>
			<th>Status</th>
			<th>Média</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@forelse($trabalhos as $trabalho) 
		<tr>
			<td>{{$trabalho->titulo}}</td>
			<td>{{$trabalho->area}}</td>
			<td>{{$trabalho->categoria}}</td>
			<td>{{$trabalho->status_avaliacao}}</td>
			<td style="font-size: 20px;"><b class="text-success">{{ number_format($trabalho->notaFinal, 2)}} </b></td>	
			<td>
				<a href="/avaliador/trabalhos/avaliar/{{$trabalho->id}}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Avaliar Trabalho"><span class="glyphicon glyphicon-search"></span></a>
			</td>
		</tr>

		@empty
		<td>
		<h3>Nenhum trabalho atribuido</h3>
		</td>
		@endforelse

	</tbody>
</table>
@stop