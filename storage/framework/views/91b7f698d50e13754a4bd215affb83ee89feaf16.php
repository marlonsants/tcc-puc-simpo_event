<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("conteudo"); ?> 

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
					<?php $__currentLoopData = $autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

					<tr>
						<td><?php echo e($autor->nome); ?></td>
						<td><?php echo e($autor->sobrenome); ?></td>
						<td><?php echo e(isset($autor->trab_cad) ? $autor->trab_cad : 0); ?></td>
						<td><?php echo e(isset($autor->trab_env) ? $autor->trab_env : 0); ?></td>
						<td><button id="detalhesDaPessoa" pessoa_id='<?php echo e($autor->id); ?>' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Detalhes do autor"><span class="glyphicon glyphicon-user"></span></button>
						<button id="trabalhosDoAutor" pessoa_id='<?php echo e($autor->id); ?>' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="trabalhos enviados"><span class="glyphicon-ice-lolly-tasted glyphicon glyphicon-education"></span></button></td>
						
					</tr>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>