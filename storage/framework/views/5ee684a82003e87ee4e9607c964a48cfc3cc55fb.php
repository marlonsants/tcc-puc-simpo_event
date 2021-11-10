<?php $__env->startSection("conteudo"); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<?php $__env->stopPush(); ?>

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
				<?php if(session()->has('msg')): ?>
				<p class="alert alert-info text text-center"><b><?php echo e(session('msg')); ?></b></p>
				<?php endif; ?>
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
					
					<?php $__empty_1 = true; $__currentLoopData = $avaliadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avaliador): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>

					<tr>
						<td><?php echo e($avaliador->nome); ?></td>
						<td><?php echo e($avaliador->sobrenome); ?></td>
						<td><?php echo e($avaliador->area); ?></td>
						<td>
								<?php if( $avaliador->status == 0 ): ?>
									<b class="text-warning">Não verificado <span class="glyphicon glyphicon-question-sign"/></b>
								<?php endif; ?>
								<?php if( $avaliador->status == 1 ): ?>
									<b class="text-success">Cadastro aprovado <span class="glyphicon glyphicon-ok-sign"/></b>
								<?php endif; ?>
								<?php if( $avaliador->status == 2): ?>
									<b class="text-danger">Cadastro reprovado <span class="glyphicon glyphicon-remove-sign"/></b>
								<?php endif; ?>	
						</td>
						<td>
							<button id="detalhesDaPessoa" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Detalhes" pessoa_id='<?php echo e($avaliador->pessoa_id); ?>'><span class="glyphicon glyphicon-search"></span></button>
							<a href="check/<?php echo e($avaliador->id); ?>/aprovar" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Aprovar Acesso" ><span class="glyphicon glyphicon-ok"></span></a>
							<a href="check/<?php echo e($avaliador->id); ?>/reprovar"  class="btn btn-danger btn-sm btn-sm"  data-toggle="tooltip" data-placement="right" title="Negar Acesso" ><span class="glyphicon glyphicon-remove"></span></a>
						</td>

					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
					<p>Nenhum avalidor cadastrado até o momento</p>
					<?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>