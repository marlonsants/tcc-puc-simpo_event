<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
	<script type="text/javascript" src="/js/mask/jquery.mask.js"></script>
	<script type="text/javascript" src="/js/pessoas.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
	<script type="text/javascript" src="/js/datatables.min.js"></script>
	<script src="/js/chart/Chart.js"></script>
	<style type="text/css">
		.justificado {text-align: justify; font-size: 12px}
		.autores{text-align: left; text-transform: uppercase; font-size: 12px;}
		.titulo{text-transform: uppercase; text-align: center;}
		.btn-success{font-size: 12px;}
	</style>
</head>
<body>
	<div class='col-md-10 col-md-offset-1'>
		<table class="table table-striped table-condensed table-bordered " id="resultado">
			<thead>
				<th>Trabalhos</th>
			</thead>
			<tbody>
				@forelse($anaisEvento as $anais)
				<tr>
					<td>
						<h5 class="titulo">{{$anais->titulo}}<br></h5>
						<div class="autores">
							<b>Autor(es):</b><br>
							@foreach($pessoas->where('trabalho_id', $anais->id) as $autor)
							{{$autor->nome}} {{$autor->sobrenome}}<br>
							@endforeach
							<br>
							<b>Categoria: </b>{{$anais->categoria}}<br>
							<b>Subarea: </b>{{$anais->area}}<br>
							<b>Instituição: </b>{{$anais->instituicao}}<br><br>
						</div>
						<div class="justificado"><b>RESUMO: </b>{{$anais->resumo}}</div><br>
						<div><a href="/anais/{{$evento_id}}/pdf/{{$anais->id}}" class="btn btn-success" target="_blank">Vizualizar o trabalho</a></div>
					</td>
				</tr>
				@empty
					<h4>Nenhum resultado a ser exibido</h4>
				@endforelse
			</tbody>
		</table><br>
	</div>
</body>

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
</html>