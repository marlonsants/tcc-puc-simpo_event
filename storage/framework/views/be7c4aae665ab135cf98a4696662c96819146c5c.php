<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("conteudo"); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="text-center">Progresso das avaliações</h4><hr>
			<table class="table table-responsive table-condensed table-bordered table-striped">
				<thead>
					<tr>
						<td><b>Trabalho</b></td>
						<td><b>Progresso da avaliação</b></td>
						<td><b>Avaliações concluídas</b></td>
						<td><b>Status</b></td>
						<td width="150"><b>Ações</b></td>
					</tr>
				</thead>
				<?php $__empty_1 = true; $__currentLoopData = $trabalhos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabalho): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>

				<tr>

					<td><?php echo e($trabalho->titulo); ?></td>
					<td width="150">
						<?php if($trabalho->avaliacoes_concluidas > 0 and $trabalho->status_id != 4): ?>
							<input type="hidden" value="">
							

							<div class="col-md-12">
								<div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e(($trabalho->avaliacoes_concluidas/$trabalho->avaliacoes_atribuidas)*100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($trabalho->avaliacoes_concluidas/$trabalho->avaliacoes_atribuidas)*100); ?>%; text-align: center;">
										<?php if($trabalho->avaliacoes_atribuidas == 0): ?>
										<p style="color:black">0</p>
										<?php endif; ?>
										<?php echo e(number_format(($trabalho->avaliacoes_concluidas/$trabalho->avaliacoes_atribuidas)*100,1)); ?>%
										
									</div>
								</div>	
							</div>
							
						<?php else: ?>
						<b>0</b>
						<?php endif; ?>
					</td>

					<?php if($trabalho->avaliacoes_atribuidas > 0): ?>
					<td><?php echo e($trabalho->avaliacoes_concluidas); ?> de <?php echo e($trabalho->avaliacoes_atribuidas); ?></td>
					<?php else: ?>
					<td>0 de <?php echo e($trabalho->avaliacoes_atribuidas); ?></td>
					<?php endif; ?>

					<td>
						<b class="<?php echo e($trabalho->decoration); ?>"><?php echo e($trabalho->status); ?> <span class="glyphicon glyphicon-info-sign"/></b>
					</td>

					<td>
						<button id="AutoresDoTrabalho" id='detalhesTrabalho' trabalho_id = '<?php echo e($trabalho->id); ?>' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Visualizar Autores"><span class="glyphicon glyphicon-user"></span></button>

						<button id='resumoDoTrabalho' trabalho_id = '<?php echo e($trabalho->id); ?>' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title= "Resumo do trabalho"><span class="glyphicon glyphicon-search"></span></button>

						<button data-toggle="collapse" data-target="#detalhes<?php echo e($trabalho->id); ?>" class="btn btn-success btn-sm" data-placement="left" title="Detalhes da avaliação"><span class="glyphicon glyphicon-eye-open" /></button>
					</td>
				</tr>

				<tr id="detalhes<?php echo e($trabalho->id); ?>" class="collapse"><!--Collapse detalhes-->
					<td colspan="5">
						<div>
							<table class="table table-responsive table-condensed table-bordered table-striped">
								<thead class="thead-padrao">
									<tr>
										<td><b>Avaliador</b></td>
										<td><b>Area</b></td>
										<td><b>Situação</b></td>
									</tr>
								</thead>

								<?php $__empty_2 = true; $__currentLoopData = $avaliadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avaliador): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_2 = false; ?>
									<?php if($avaliador->trabalho_id == $trabalho->id): ?>
									<tr>
										<td><?php echo e($avaliador->nome); ?></td>
										<td><?php echo e($avaliador->area); ?></td>
										<td>
											<?php if($avaliador->situacao == 1): ?>
											<b class="text-danger"><?php echo e($avaliador->status_avaliacao); ?></b>
											<?php endif; ?>
											<?php if($avaliador->situacao == 2): ?>
											<b class="text-primary"><?php echo e($avaliador->status_avaliacao); ?></b>
											<?php endif; ?>
											<?php if($avaliador->situacao == 3): ?>
											<b class="text-success"><?php echo e($avaliador->status_avaliacao); ?></b>

											<?php $__currentLoopData = $parecer_avaliacao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parecer): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<?php if($avaliador->trabalho_id == $parecer->trabalho_id): ?>
													<?php if($avaliador->id == $parecer->avaliador_id): ?>
														<p style="text-align: justify;"><b>Parecer:</b><br>"<?php echo e($parecer->parecer); ?>"</p>
													<?php endif; ?>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

											<?php endif; ?>

											
										</td>
									</tr>
									<?php endif; ?>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_2): ?>
								<tr><td colspan="3"><p class="text-warning">Nenhum avaliador atribuido até o momento</p></td></tr>
								<?php endif; ?>
							</table>
						</div>
					</td>
				</tr><!--Fim Collapse detalhes-->

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
				<tr><td colspan="5"><p>Nenhum trabalho submetido até o momento</p></td></tr>
				<?php endif; ?>	

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
					<table class="table table-responsive table-condensed table-striped">
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

	</div>
</div>

<script type="text/javascript">
	modalAutoresDoTrabalho('modal_detalhes');
	modalResumoDoTrabalho('modal_detalhes');

	$(document).on('click','.check',function(){
		// vierifica quais checkbox foram selecionados
		ativos = $('.check:checked').serialize();
		
		// envia o array com os chekbox por get
		

		$.ajax({
		    url: "/administrador/autores/trabalhos/filtro/",
		    method: 'GET',
		    data: ativos,
		    //dataType:"json",
		    success: function( data ) 
		    {
		        
		        console.log(data);
		    },
		    error: function(data){
		    	console.log(data);
		    }
		});	

	});
</script>



<?php $__env->stopSection(); ?> 
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>