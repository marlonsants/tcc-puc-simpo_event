@extends('/usuarios/administradores/header')
@section("conteudo")
@push('scripts')
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
@endpush

<div class="row">
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">

		<!-- ================================================================ -->
		<!-- inicio do modal com as informações do avaliador -->
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
		<!-- fim do modal  -->

		<!-- =============================================================== -->
			<h4 class="text-center">Lista de Avaliadores cadastrados</h3><hr>
			<a target="_blank" class="btn btn-success pull-right" href="/administrador/exportar/avaliadores">
				Exportar em PDF <span class="glyphicon glyphicon-open-file"></span>
			</a>
				@if(session()->has('msg'))
				<p class="alert alert-info text text-center"><b>{{session('msg')}}</b></p>
				@endif
			<table class="table table-bordered table-responsive table-condensed table-bordered table-stripped" id="lista_avaliadores">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>Area</th>
						<th>Status</th>
						<th width="100">Ações</th>
					</tr>
				</thead>

				<tbody>
					
					@forelse($avaliadores as $avaliador)

					<tr>
						<td>{{ $avaliador->nome }}</td>
						<td>{{$avaliador->sobrenome}}</td>
						<td>{{ $avaliador->area}}</td>
						<td>
								@if ( $avaliador->status == 0 )
									<b class="text-warning">Não verificado <span class="glyphicon glyphicon-question-sign"/></b>
								@endif
								@if ( $avaliador->status == 1 )
									<b class="text-success">Cadastro aprovado <span class="glyphicon glyphicon-ok-sign"/></b>
								@endif
								@if ( $avaliador->status == 2)
									<b class="text-danger">Cadastro reprovado <span class="glyphicon glyphicon-remove-sign"/></b>
								@endif	
						</td>
						<td>
							<button id="detalhesDaPessoa" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Detalhes" pessoa_id='{{$avaliador->pessoa_id}}'><span class="glyphicon glyphicon-search"></span></button>
							<a href="check/{{$avaliador->id}}/aprovar" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Aprovar Acesso" ><span class="glyphicon glyphicon-ok"></span></a>
							<a href="check/{{$avaliador->id}}/reprovar"  class="btn btn-danger btn-sm btn-sm"  data-toggle="tooltip" data-placement="right" title="Negar Acesso" ><span class="glyphicon glyphicon-remove"></span></a>
						</td>

					</tr>
					@empty
					<p>Nenhum avalidor cadastrado até o momento</p>
					@endforelse
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	ModalDetPessoa('modal_detalhes');

	$(document).ready(function(){
		$('#lista_avaliadores').DataTable(
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
	 $("#lista_avaliadores_wrapper").addClass("text-center");	
	 $("#lista_avaliadores_filter").addClass("text-left");
	 $("#lista_avaliadores_length").hide();
	});


</script>
@stop