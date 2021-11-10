<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("conteudo"); ?>
<div class="row">
	<div class="container-fluid">
		<?php if(Session::has('mensagem')): ?>
		<div class="<?php echo e(Session::get('alertType')); ?> text-center"><p><b><?php echo e(Session::get('mensagem')); ?></b></p></div>
		<?php endif; ?>
		<div class="col-md-12">
			<h4 class="text-center">Avaliação auxiliar</h4><hr>
			<table class="table table-bordered table-responsive table-condensed table-bordered" id="pre_avaliacao">
				<thead>
					<tr>
						<th>Título</th>
						<th>Área</th>
						<th>Categoria</th>
						<th>Status</th>
						<th width="300">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $trabalhos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabalho): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>

					<tr>
						<td><?php echo e($trabalho->titulo); ?> </td>
						<td><?php echo e($trabalho->area); ?> </td>
						<td><?php echo e($trabalho->categoria); ?> </td>
						<td>
							<b class="<?php echo e($trabalho->decoration); ?>"><?php echo e($trabalho->status); ?> <span class="glyphicon glyphicon-info-sign"/></b>
						</td>
						<td>
							<button id='AutoresDoTrabalho' trabalho_id = '<?php echo e($trabalho->id); ?>' acao='autores' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Visualizar Autores" url='administrador/buscaPessoa'><span class="glyphicon glyphicon-user"></span></button>

							<button id='resumoDoTrabalho' trabalho_id = '<?php echo e($trabalho->id); ?>' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title= "Resumo do trabalho"><span class="glyphicon glyphicon-search"></span></button>

							<button  trabalho_id="<?php echo e($trabalho->id); ?>" acao="reprovar" class="btn btn-danger btn-sm avaliar" data-toggle="tooltip" data-placement="left" title="Reprovar o trabalho"><span class="glyphicon glyphicon-remove"></span></button>

							<?php if($trabalho->status_id != 4): ?>
								<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" target="_blank" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho"><span class="glyphicon glyphicon-download-alt"/></a>
							
								<button data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-warning btn-sm" data-placement="left" title="Acrecentar observações">
									<span class="glyphicon glyphicon-plus"></span>
								</button>

								<button data-toggle="collapse" data-target="#TodasObservacoesTrab<?php echo e($trabalho->id); ?>" class="btn btn-danger btn-sm" data-placement="left" title="observações registradas">
									<span class="glyphicon glyphicon-tasks"></span>
								</button>
								<?php if($dataAtual > $data_fim_ava): ?>
								<button class="btn btn-primary btn-sm correcao" trabalho_id="<?php echo e($trabalho->id); ?>" data-toggle="tooltip" data-placement="right" title="solicitar correção do trabalho" status_id="<?php echo e($trabalho->status_id); ?>"><span class="glyphicon glyphicon-list-alt"></span></button>
								<?php endif; ?>
							<?php endif; ?>
						</td>
					</tr>

					<tr id="obs<?php echo e($trabalho->id); ?>" class="collapse">
						<td colspan="5">
							<div class="col-md-12">
								<form  action="/administrador/pre_avaliador/parecer" method="post" accept-charset="utf-8" class="form-group">
									<?php echo e(csrf_field()); ?>		

									<input type="hidden" name="trabalho_id" value="<?php echo e($trabalho->id); ?>">
									<textarea data-placement="bottom" data-toggle="popover" title="Quando este campo perder o foco o texto será salvo automaticamente, sendo assim para fazer alterações nas observações de avaliação basta digitar e clicar em qualquer parte da tela com o mouse" class="form-control" id="inputParecer" name="parecer" value="<?php echo e(isset($parecer->parecer) ? $parecer->parecer : ''); ?>" style="height: 100px"><?php echo e(isset($trabalho->observacao) ? $trabalho->observacao : ''); ?></textarea>
								</form>
								<?php if(!empty($trabalho->observacao)): ?>

								<form method="post" action="/administrador/deletar/parecer">
									<?php echo e(csrf_field()); ?>

									<input type="hidden" value="<?php echo e($trabalho->id); ?>" name="trabalho_id"> 
									<button style="float: left;" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
									</h4>
								</form>

								<?php endif; ?>
							</div>
						</td>		
					</tr>

					<tr class="collapse" id="TodasObservacoesTrab<?php echo e($trabalho->id); ?>">
						<td colspan="5">
							<div class="col-md-12">
								<?php if(!empty($pre_avaliacoes[0]) ): ?>
									<?php $__empty_2 = true; $__currentLoopData = $pre_avaliacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_ava): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_2 = false; ?>
										<?php if($p_ava->trabalho_id == $trabalho->id): ?>
											<p class="text-left">Responsável: <?php echo e($p_ava['nome']); ?></p>
											<textarea style="height: 100px" class="form-control" readonly><?php echo e($p_ava['observacao']); ?></textarea>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_2): ?>
									<h5>Nenhuma observação foi registrada até o momento</h5>
									<?php endif; ?>
								<?php endif; ?>

							</div>
						</td>
					</tr>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
					<tr> 
						<td colspan="5">
							<p>Nenhum trabalho cadastrado até o momento</p>	
						</td>
					</tr>
					
					<?php endif; ?>	

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

		<!-- modal que questiona a ação do usuário  -->
		<div class="modal fade" id="modal_correcao">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<center><h3 class="modal-title">Atenção !</h3></center>
					</div>
					<div class="modal-body text-center" id="msg_correcao">
						
					</div>
					<div class="modal-footer" id="footer_correcao">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><FIELDSET>Não</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

	</div>
</div>

<style type="text/css">
	textarea{width: 100%; height: 75px;}
</style>

<script type="text/javascript">
	modalAutoresDoTrabalho('modal_detalhes');
	modalResumoDoTrabalho('modal_detalhes');
	modalAvaliarTrabalho();

	$(document).on('blur','#inputParecer', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});

	$(document).on('click','.correcao', function(){
		status_id = $(this).attr('status_id');
		trabalho_id = $(this).attr('trabalho_id');
		$('#msg_correcao').html(' ');
		$('#footer_correcao').html(' ');
		if(status_id == 2 || status_id == 5){
			$('#msg_correcao').append('<h4>Deseja enviar uma solicitação de correção ?</h4>');
		}else if(status_id == 7){
			$('#msg_correcao').append('<h4>O autor já enviou a correção, deseja fazer uma nova solicitação ?</h4>');
		}else if(status_id == 6){
			$('#msg_correcao').append('<h4>O autor não enviou a correção, deseja cancelar essa solicitação ?</h4>');
		}
		$('#footer_correcao').prepend('<a  href="/administrador/trabalhos/correcao/'+trabalho_id+'" class="btn btn-success">Sim</a><button type="button" class="btn btn-danger" data-dismiss="modal"><FIELDSET>Não</FIELDSET></button>');
		$('#modal_correcao').modal();
	});

</script>



<?php $__env->stopSection(); ?> 
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>