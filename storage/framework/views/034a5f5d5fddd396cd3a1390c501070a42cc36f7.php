<?php $__env->startSection('conteudo'); ?> 
<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="/js/abrirModal.js"></script>
<?php $__env->stopPush(); ?>
<div class="row">
	
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">

			<?php if(Session::has('msg')): ?>
				<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('msg')); ?></b></p></div>
			<?php endif; ?>

			<?php if(isset($_GET['msg_erro'])): ?>
				<div class="row">
					<div class='alert alert-danger text-center'><?php echo e($_GET['msg_erro']); ?></div>
				</div>
			<?php endif; ?>
			<?php if(isset($_GET['suc']) ): ?>
				<div class="row">
					<div class='alert alert-success text-center'><?php echo e($_GET['suc']); ?></div>
				</div>
			<?php endif; ?>

			<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
				<h3 class="text-center">Listagem de Trabalhos</h3>
				<hr>
				<thead>
					<tr>
						<th>Título</th>
						<th>Status</th>
						<!-- <th>Nota</th> -->
						<th width="500" colspan="1">Ações</th>
					</tr>
				</thead>
				<tbody>

					<?php $__empty_1 = true; $__currentLoopData = $trabalhos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabalho): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
					<tr>
						<td width="400"><?php echo e($trabalho->titulo); ?></td>
						
						<!-- se as avaliações já tiverem sido encerradas -->
						<?php if($arrayDatas['dataAtual'] > $arrayDatas['data_fim_ava']): ?>
							
								
									
							<!-- se em avaliação ou aguardando avaliação -->
							<?php if($trabalho->status_id == 3 or $trabalho->status_id == 5): ?>
								<td class="text-warning">Trabalho não avaliado, para mais detalhes entre em contato com a comissão ciêntifica do evento<span class="glyphicon glyphicon-info-sign" /></td>
							<?php else: ?> 
								<td><b class="<?php echo e($trabalho->decoration); ?>"><?php echo e($trabalho->status); ?> <span class="glyphicon glyphicon-info-sign"/></b></td>
							<?php endif; ?>
							
						
						<?php else: ?>
						<!-- durante a avaliação 	 -->
							<!-- se aprovado ou aguardando aprovação (trabalho avaliado) -->
							<?php if($trabalho->status_id == 1 or $trabalho->status_id == 2 ): ?>
								<td class="text-warning">Em avaliação<span class="glyphicon glyphicon-info-sign" /></td>
							<?php else: ?>
								<td><b class="<?php echo e($trabalho->decoration); ?>"><?php echo e($trabalho->status); ?> <span class="glyphicon glyphicon-info-sign"/></b></td>
							<?php endif; ?>

						<?php endif; ?>
						<!-- fim dos status -->
						<!-- se as avaliações ja tiverem sido encerradas mostra a nota do trabalho se não mostra nota não atribuida -->
						<!-- <?php if($arrayDatas['dataAtual'] > $arrayDatas['data_fim_ava'] ): ?>
							<td style="font-size: 22px"><b><?php echo e(number_format($trabalho->notaFinal, 2)); ?></b></td>
						<?php else: ?>
							<td><b>Não atribuida<b></td>
						<?php endif; ?> -->

								
							<td width="400px">
							<!-- Este bloco controla o que deve ser exibido no campo ações durante a subimissão de trabalhos  -->
							<?php if($arrayDatas['dataAtual'] >= $arrayDatas['data_ini_sub'] and $arrayDatas['dataAtual'] <= $arrayDatas['data_fim_sub'] ): ?>

								<!-- se por erro de configuração de data o trabalho for aprovado, reprovado ou avaliado mesmo durante a submissão mostra apenas o botão visualizar trabalho para não causar maiores problemas -->
								<?php if($trabalho->status_id == 1 or $trabalho->status_id == 2 or $trabalho->status_id == 3): ?>
									<!-- botão visualiazar trabalho		 -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
									
								<?php endif; ?>
								<!-- se o pdf do trabalho ainda não foi enviado  -->
								<?php if($trabalho->status_id == 4): ?>
								<!-- Input para enviar o pdf do trabalho -->
									<form action="<?php echo e(url('autor/trabalhos/upload')); ?>" method="post" enctype="multipart/form-data" style="display: inline">
									<?php echo csrf_field(); ?>

									<div class="btn-group">
										<input class="btn btn-sm btn-default" type="file" name="pdf" style='padding:5px' required></input>
										<input type="hidden" name="id_trabalho" value="<?php echo e($trabalho->id); ?>">
										<input type="submit" name="submit" class="btn btn-sm btn-primary">
									</form>

									<!-- Botão para excluir o trabalho -->
									<form action="<?php echo e(url('autor/trabalhos/delete')); ?>" method="post" id="form_excluir<?php echo e($trabalho->id); ?>" style="display: inline">
										<?php echo csrf_field(); ?>

										<div class="btn-group">
											<input type="hidden" name="id_trabalho" value="<?php echo e($trabalho->id); ?>">

											<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar-excluir" data-placement="left" title="Excluir trabalho" data-original-title="Excluir trabalho" id="btn-excluir<?php echo e($trabalho->id); ?>"><span class="glyphicon glyphicon-trash"></span> </button>

										</div>
									</form>

									<a href="editar/<?php echo e($trabalho->id); ?>" type="button"  data-toggle="tooltip" data-placement="top" title="Editar as informações do trabalho" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil EditarTrabalho"></span></button>

								<?php endif; ?>
								<!-- se o Pdf já foi enviado 	 -->
								<?php if($trabalho->status_id == 5): ?>
									<!-- botão visualiazar trabalho		 -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho"  target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
									

									<!-- botão enviar substituir PDF  -->
									<button type="button" trabalho_id="<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary subPdf" data-toggle="tooltip" data-placement="top" title="Enviar o trabalho corrigido"><span class="glyphicon glyphicon-open-file"></span></button>

									
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
												<span class="glyphicon glyphicon-plus"></span>
									</button>

									<!-- botão excluir trabalho -->
									<form action="<?php echo e(url('autor/trabalhos/delete')); ?>" method="post" id="form_excluir<?php echo e($trabalho->id); ?>" style="display: inline">
										<?php echo csrf_field(); ?>

										<div class="btn-group">
											<input type="hidden" name="id_trabalho" value="<?php echo e($trabalho->id); ?>">

											<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar-excluir" data-placement="left" title="Excluir trabalho" data-original-title="Excluir trabalho" id="btn-excluir<?php echo e($trabalho->id); ?>"><span class="glyphicon glyphicon-trash"></span> </button>

										</div>
									</form>	

									<a href="editar/<?php echo e($trabalho->id); ?>" type="button"  data-toggle="tooltip" data-placement="top" title="Editar as informações do trabalho" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil EditarTrabalho"></span></button>
									
								<?php endif; ?>
							<?php endif; ?>
							<!-- fim do bloco que controla o periodo de submissão de trabalhos -->

							<!-- Este bloco controla o que deve ser exibido no campo ações durante a avaliação de trabalhos  -->
							<?php if($arrayDatas['dataAtual'] >= $arrayDatas['data_ini_ava'] and $arrayDatas['dataAtual'] <= $arrayDatas['data_fim_ava'] ): ?>
								<!-- se o pdf não foi enviado bloqueia todas as ações -->
								<?php if($trabalho->status_id == 4): ?>
									<p class="text-danger">PDF não enviado no prazo </p>
								<?php endif; ?>

								<!-- se o trabalho estiver aprovado, avaliado aguardando aprovação ,em avaliação ou aguardando avaliação -->
								<?php if($trabalho->status_id == 1 or $trabalho->status_id == 2 or  $trabalho->status_id == 3 or $trabalho->status_id == 5 or  $trabalho->status_id == 6): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho"  target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
											<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
												<span class="glyphicon glyphicon-plus"></span>
											</button>
										
									
								<?php endif; ?>
								<!-- se o trabalho possuir correção -->
								<?php if($trabalho->status_id == 7): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho"  target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
											<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
												<span class="glyphicon glyphicon-plus"></span>
											</button>
										
									
								<?php endif; ?>
							
							<!-- fim do periodo durante a avaliação	 -->
							<?php endif; ?>
							<!-- se as avaliações ja tiverem sido encerradas -->
							<?php if($arrayDatas['dataAtual'] > $arrayDatas['data_fim_ava'] ): ?>
								<!-- se o trabalho foi aprovado -->
								<?php if($trabalho->status_id == 1): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
										<span class="glyphicon glyphicon-plus"></span>
									</button>

									<button id='NotasCriterios' trabalho_id = '<?php echo e($trabalho->id); ?>' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title= "Notas dos criterios de avaliação"><span class="glyphicon glyphicon-education"></span></button>
										
								
									<!-- botão visualizar aceite de apresentação -->
									<form action="<?php echo e(url('autor/trabalhos/visualizarComprovante')); ?>" method="post" style="display: inline-block;" target="_blank">
										<?php echo csrf_field(); ?>

										<input type="hidden" name="id_trabalho" value="<?php echo e($trabalho->id); ?>" readonly="readonly">
										<button class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="top" title="Baixar aceite de apresentação do trabalho" type="submit"><span class="glyphicon glyphicon-save-file" /></button>
									</form>
								<?php endif; ?>
								<!-- se o trabalho está aguardando aprovação -->
								<?php if($trabalho->status_id == 2): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
										
									
								<?php endif; ?>
								<!-- se o pdf não foi enviado -->
								<?php if($trabalho->status_id == 4): ?>
									<p class="text-danger">PDF não enviado no prazo </p>
								<?php endif; ?>

								<!-- se o trabalho foi não foi avaliado -->
								<?php if($trabalho->status_id == 3 or $trabalho->status_id == 5): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
										
								
								<?php endif; ?>
								<!-- se o trabalho possuir correçao -->
								<?php if($trabalho->status_id == 6): ?>

									<!-- botão enviar substituir PDF  -->
									<button type="button" trabalho_id="<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary subPdf" data-toggle="tooltip" data-placement="top" title="Enviar o trabalho corrigido"><span class="glyphicon glyphicon-open-file"></span></button>

									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
										
									
								<?php endif; ?>

								<!-- se o trabalho possuir correção -->
								<?php if($trabalho->status_id == 7): ?>
									<!-- botão visualizar trabalho  -->
									<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><span class="glyphicon glyphicon-download-alt"/></a>
										<!-- se tiver parecer mostrar o botão visualizar parecer -->
										
									<button type="button" data-toggle="collapse" data-target="#obs<?php echo e($trabalho->id); ?>" class="btn btn-sm btn-primary" data-placement="top" title="clique para ver os comentários de avaliação">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
										
									
								<?php endif; ?>
							<?php endif; ?>
						</td>

						</tr>
						<tr>
							<td colspan="4">
								<?php $parecerValid = false?>
								<?php if($arrayDatas['dataAtual'] > $arrayDatas['data_fim_ava']): ?>
									<?php if(!empty($parecer[0])): ?>
										<?php $__currentLoopData = $parecer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($p['trabalho_id'] == $trabalho->id): ?>
											<div>

												<p id="obs<?php echo e($trabalho->id); ?>" readonly class="ls-collapse-opened obs"><b>Comentário do avaliador:</b> <?php echo e($p['parecer']); ?></p>
											</div>
											<?php $parecerValid = true ?> 	
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>

								

									<?php if(!empty($pre_avaliacoes[0])): ?>
										<?php $__currentLoopData = $pre_avaliacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										
											<?php if($p['trabalho_id'] == $trabalho->id): ?>
											<div>
												<p id="obs<?php echo e($trabalho->id); ?>" readonly class="ls-collapse-opened obs"><b>Comentário da comissão ciêntifica:</b> <?php echo e($p['observacao']); ?></p>
											</div>
											<?php $parecerValid = true ?> 
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								
									<?php endif; ?>
								<?php else: ?>			
									<?php if($parecerValid == false): ?>
										<div>
											<p id="obs<?php echo e($trabalho->id); ?>" readonly class="collapse obs">Não foi registrado comentário de avaliação para este trabalho
											</p>
										</div>
									<?php endif; ?>
								<?php endif; ?>		
							</td>
						</tr>

						<script> 
							$("#btn-excluir<?php echo e($trabalho->id); ?>").click(function(){

								$("#corpoConfirmacao").html('Tem certeza que deseja remover este Trabalho?');
								btn = '<button onclick="excluirTrabalho<?php echo e($trabalho->id); ?>()" data-toggle="tooltip" data-placement="top" title="Excluir trabalho" id="btn-excluir<?php echo e($trabalho->id); ?>" type="button"  id="form_excluir" class="btn btn-sm btn-danger"  name="delete"><span class="glyphicon glyphicon-trash"></span> </button>';
								$("#corpoConfirmacaoBotoes").html(btn);

							});

							function excluirTrabalho<?php echo e($trabalho->id); ?>(){
								$("#form_excluir<?php echo e($trabalho->id); ?>").submit();
							}
						</script>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
						<h3>Nenhum trabalho cadastrado até o momento</h3>
						<?php endif; ?>
					</tbody>
				</table>

				<!-- Modal -->
				<div class="modal fade" id="confirmar-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 	>
					<div class="modal-dialog" role="document" style="width:70%">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Atenção!</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-xs-12">
										<div  id="corpoConfirmacao" style="text-align: center;">

										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer" id="corpoConfirmacaoBotoes">
								<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
							</div>
						</div>
					</div>
				</div>

				<!-- modal que mopstra o input file para editar o pdf -->
				<div class="modal fade" id="modal_pdf" >
					<div class="modal-dialog modal-md" role="document" style="z-index: inherit;">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4><center class="modal-title">Subtituir o PDF enviado</center></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12 col-md-offset-1">
									<form action="<?php echo e(url('autor/trabalhos/upload')); ?>" method="post" enctype="multipart/form-data">
										<?php echo csrf_field(); ?>

										<div class="btn-group">
											<input class="btn btn-sm btn-default" type="file"  name="pdf" style='padding:5px' required>
											<input type="hidden" id="inputSubPdf" name="id_trabalho" value="">
											<input type="submit" name="submit" class="btn btn-sm btn-primary">
										</form>	
									</div>
								</div>
								<div class="modal-footer">

									<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- fim do modal -->
				</div>
			</div>
			<!-- modal notas dos criterios -->
				<div class="modal fade" id="modal_criterios">
					<div class="modal-dialog" role="document" style="width: 90%">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #101010;">
								<center><h3 class="modal-title title-criterios">Notas dos criterios de avaliação</h3></center>
							</div>
							<div class="modal-body" id="notas_criterios">
								
								
							</div>
							<div class="modal-footer footer-criterios">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
							</div>
						</div>
					</div>
				</div>
		<!-- fim do modal -->

		</div>

		<script type="text/javascript">
			modalEditPdf();
		</script>

		<style type="text/css">
			.obs {color: white; background-color: #5F9EA0; padding: 10px; text-align: left;}
		</style>

		
		<?php $__env->stopSection(); ?>	
<?php echo $__env->make('/usuarios/autores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>