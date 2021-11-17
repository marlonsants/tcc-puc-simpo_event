@extends('/usuarios/administradores/header')
@push('scripts')
<link rel="stylesheet" type="text/css" href="/css/datatables.min.js">
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<script type="text/javascript" src="/js/datatables.min.js"></script>
@endpush

@section("conteudo")
<div class="row">
	<div class="container-fluid">
		
		<div class="col-md-12">
			@if(session()->has('msg'))
				<p class="alert alert-success text-center"><b>{{session('msg')}}</b></p>
			@endif
			<h4 class="text-center">Trabalhos cadastrados</h4><hr>
			<a target="_blank" class="btn btn-success pull-right" href="/administrador/exportar/trabalhos">
				Exportar em PDF <span class="glyphicon glyphicon-open-file"></span>
			</a>
			<table class="table table-bordered table-responsive table-condensed  table-bordered table-stripped" id="tabelaTrabalhos">
							
				<thead>
					<tr>
						<th>Título</th>
						<th>Área</th>
						<th>Categoria</th>
						<th>Status</th>
						<th>Nota final</th>
						<th width="220">Ações</th>
					</tr>
				</thead>
				<tbody>
					@forelse($trabalhos as $trabalho)

					<tr>
						<td>{{$trabalho->titulo}} </td>
						<td>{{$trabalho->area}} </td>
						<td>{{$trabalho->categoria}} </td>
						<td>
							<b class="{{$trabalho->decoration}}">{{$trabalho->status}} <span class="glyphicon glyphicon-info-sign"/></b>
						</td>
						<td class="{{$trabalho->decoration}}" style="font-size: 20px;">
							<b>{{number_format($trabalho->notaFinal, 2)}}</b>
						</td>
						<td>
							<button  trabalho_id="{{$trabalho->id}}" acao="reprovar" class="btn btn-danger btn-sm avaliar" data-toggle="tooltip" data-placement="left" title="Reprovar o trabalho"><span class="glyphicon glyphicon-remove"></span></button>

							<button   trabalho_id="{{$trabalho->id}}" acao="aprovar" class="btn btn-success btn-sm avaliar" data-toggle="tooltip" data-placement="left" title="Aprovar o trabalho"><span class="glyphicon glyphicon-ok"></span></button>

							<button id="AutoresDoTrabalho" trabalho_id = '{{$trabalho->id}}' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Visualizar Autores"><span class="glyphicon glyphicon-user"></span></button>

							<button id='resumoDoTrabalho' trabalho_id = '{{$trabalho->id}}' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title= "Resumo do trabalho"><span class="glyphicon glyphicon-search"></span></button>

							<button id='NotasCriterios' trabalho_id = '{{$trabalho->id}}' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title= "Notas dos criterios de avaliação"><span class="glyphicon glyphicon-education"></span></button>

							<a href="/autor/trabalhos/visualizar/{{$trabalho->id}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
						</td>
					</tr>
					@empty
					<p>Nenhum trabalho cadastrado até o momento</p>	
					@endforelse	

				</tbody>
			</table>
		</div>

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

		<!-- modal para aprovar ou reprovar o trabalho -->
		<div class="modal fade" id="modal_avaliar">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<center><h4 class="modal-title title-avaliar"></h4></center>
					</div>
					<div class="modal-body" id="conteudo">
						<table class="table table-bordered table-responsive table-condensed table-striped">
							<p id='body-avaliar' class="text-center"></p>
						</table>
					</div>
					<div class="modal-footer footer-avaliar">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

		<!-- modal notas dos criterios -->
		<div class="modal fade" id="modal_criterios">
			<div class="modal-dialog" role="document" style="width: 90%">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #101010;">
						<center><h3 class="modal-title title-criterios">Notas dos criterios de avaliação</h3></center>
					</div>
					<div class="modal-body" id="notas_criterios" style="overflow: auto;" >
						
						
					</div>
					<div class="modal-footer footer-criterios">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

	</div>
</div>


<script type="text/javascript">
	modalAutoresDoTrabalho('modal_detalhes');
	modalResumoDoTrabalho('modal_detalhes');
	modalAvaliarTrabalho();


	
	$(document).ready(function(){
		$('#tabelaTrabalhos').DataTable(
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
	 $("#tabelaTrabalhos_wrapper").addClass("text-center");	
	 $("#tabelaTrabalhos_length").hide();
	 
	 
	});

</script>
<br>
@stop 