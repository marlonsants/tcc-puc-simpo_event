@extends('/usuarios/administradores/header')

@push('scripts')
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
@endpush

@section("conteudo") 

<div class="row">
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">
			
			<!-- modal que mopstra as informações detalhadas do autor -->
			<div class="modal fade" id="modal_detalhes">
				<div class="modal-dialog" style="width: 90%" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<center><h4 class="modal-title"></h4></center>
						</div>
						<div class="modal-body" id="conteudo">
							<table class="table table-bordered table-responsive table-condensed table-striped">
								<thead id='ModalHead' class="thead-padrao"></thead>
								<tbody id='body'></tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
						</div>
					</div>
				</div>
			</div>
			<!-- fim do modal -->
			<h4 class="text-center">Lista de autores cadastrados</h4><hr>
			<table class="table table-bordered table-responsive table-condensed  table-bordered table-stripped" id="lista_autores">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>Trabalhos cadastrados</th>
						<th>Trabalhos enviados</th>
						<th width="70">Ações</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($autores as $autor)

					<tr>
						<td>{{$autor->nome}}</td>
						<td>{{$autor->sobrenome}}</td>
						<td>{{$autor->trab_cad or 0}}</td>
						<td>{{$autor->trab_env or 0}}</td>
						<td><button id="detalhesDaPessoa" pessoa_id='{{$autor->id}}' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Detalhes do autor"><span class="glyphicon glyphicon-user"></span></button>
						<button id="trabalhosDoAutor" pessoa_id='{{$autor->id}}' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="trabalhos enviados"><span class="glyphicon-ice-lolly-tasted glyphicon glyphicon-education"></span></button></td>
						
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	ModalDetPessoa('modal_detalhes');
	ModalTrabalhosDoAutor('modal_detalhes');

	$(document).ready(function(){
		$('#lista_autores').DataTable(
		{
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
	 $("#lista_autores_wrapper").addClass("text-center");	
	 $("#lista_autores_filter").addClass("text-left");
	 $("#lista_autores_length").hide();
	});

</script>
@stop