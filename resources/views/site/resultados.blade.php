@extends('/site/header')
@section('conteudo')


<div class="panel panel-default">
	<div class="col-md-2"><img src="{{ asset('images/SGAGRO_LOGO.png') }}" class="img" width="80" height="60" ></div>
	<div class="panel-heading"><h3 style="padding-left:30%;padding-top:0px; padding-top: 0px;"><b>Trabalhos aprovados para o VI SGAgro</b></h3></div>
	
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

				<table class="tabela1 table table-striped table-condensed table-bordered" id="resultado">
					<thead>
						<th>Titulo</th><th>Área</th>
					</thead>
					<tbody>
						@forelse($trabalhos as $trabalho)
							<tr>
								<td>{{$trabalho->titulo}}</td>
								<td>{{$trabalho->area}}</td>
								
							</tr>	
						@empty
							<h4>Nenhum resultado a ser exibido</h4>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="panel panel-footer">
		<p style="font-weight: bold">A publicação dos trabalhos nos Anais do VI SGAgro é condicionada a inscrição de, ao menos, um dos autores de cada trabalho no evento.</p>
	</div>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){
	$('#resultado').DataTable(
	{
		"pageLength": 5,
		language: {
			"decimal":        "",
			"emptyTable":     "Não há informações a ser exibida",
			"info":           "Mostrando _START_ até _END_ de _TOTAL_ registros.",
			"infoEmpty":      "Mostrando 0 até 0 de 0 registros.",
			"infoFiltered":   "(Do total de _MAX_ registros)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrando _MENU_ registros.",
			"loadingRecords": "Carregando...",
			"processing":     "Processando...",
			"search":         "Pesquisar:",
			"zeroRecords":    "Não foi encontrada nenhuma informação",
			"paginate": {
				"first":      " Primeira ",
				"last":       " Última ",
				"next":       " Proxima ",
				"previous":   " Anterior "
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		}
	});

	$("input[type=search]").addClass("form-control");
	$("#resultado_wrapper").addClass("text-center");	
	$("#resultado_filter").addClass("text-left");
	$("#resultado_length").hide();	});

</script>


@stop