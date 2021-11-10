<?php $__env->startSection('conteudo'); ?>

<?php if(Session::has('mensagem')): ?>
	<div class="<?php echo e(Session::get('alertType')); ?> text-center"><p><b><?php echo e(Session::get('mensagem')); ?></b></p></div>
<?php endif; ?>
<div class="row">
	<div class="col-md-12 panel panel-default">
		<a href="/autor/trabalhos/visualizar/<?php echo e($trabalho->id); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><b>Clique aqui para visualizar trabalho</b></a>
		<h4>Informações do trabalho:</h4>
		<h5><b>Titulo:</b> <?php echo e($trabalho->titulo); ?></h5>
		<h5><b>Area:</b> <?php echo e($trabalho->area); ?></h5>
		<h5><b>Categoria:</b> <?php echo e($trabalho->categoria); ?></h5>
		<h5><b>Resumo:</b> <?php echo e($trabalho->resumo); ?></h5>
		<h5><b>Palavras Chave:</b> <?php echo e($trabalho->palavra_chave); ?></h5>
		<h5><b>Abstract:</b> <?php echo e($trabalho->abstract); ?></h5>
		<h5><b>Key words:</b> <?php echo e($trabalho->key_word); ?></h5>
		
	</div>
</div>

<?php if(Session::has('msgNotaMax')): ?>
<br><div class="<?php echo e(Session::get('alertType')); ?> text-center col-md-12"><p><b><?php echo e(Session::get('msgNotaMax')); ?></b></p></div>
<?php endif; ?>

<div class="row">
	<?php if(isset($Criterios)): ?>
	<?php $__currentLoopData = $Criterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<div class="col-md-3 col-xs-12">
		
		<form action="/avaliador/criterio/nota" method="post" accept-charset="utf-8" class="form-group">
			<?php echo e(csrf_field()); ?>


			<div class="col-md-12">

				<div class="row">
					<div style="margin-top:5px;margin-left: 20px;font-weight: bold"><?php echo e($criterio->nome); ?> (Peso <?php echo e($criterio->peso); ?>)</div>
			
					<div class="col-md-8 col-xs-8">
						<input <?php echo $trabalho->status_avaliacao == 3?'readonly':'' ?> data-placement="bottom" data-toggle="popover" title="Instruções" data-content="Quando este campo perder o foco a nota será salva automaticamente"   required type="number" name="nota" min='0' max="<?php echo e($notaMax); ?>" value="<?php echo e(isset($criterio->nota) ? $criterio->nota : ''); ?>" class="form-control inputNota" placeholder='Nota de 0 a <?php echo e($notaMax); ?>'>

						<input type="hidden" name="trabalho_id" value="<?php echo e($trabalho->id); ?>">
						<input type="hidden" name="criterio_id" value="<?php echo e($criterio->id); ?>">
					</div>
					<div class="col-md-4 col-xs-4">
						<a href="/administrador/cadastros_basicos/criterios/detalhes/<?php echo e($criterio->id); ?>"
							class="btn btn-primary" data-toggle="modal" data-target="#<?php echo e($criterio->id); ?>"
							style="margin-top:5px">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>
						<!-- <button type="submit" class="btn btn-success" style="margin-top:5px">
							<span class="glyphicon glyphicon-send"></span>
						</button> -->
						
					</div>
				</div>


			</div>
			<hr>
		</form>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</div>
<div class="col-md-8 col-md-offset-2">
	<div class="row">
		<div class="col-md-4 col-md-offset-5">
			
			<?php if(!isset($parecer->parecer)): ?>
			<div class="row">
				<h4><b>Parecer:</b> 
					<button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#NewParecer" data-placement="left"><span class="glyphicon glyphicon-plus" ></span></button>
				</h4>	
			</div>
			<?php endif; ?>		
			<?php if(isset($parecer->parecer)): ?>
			<div class="row">
				<form method="post" action="<?php echo e(url('\avaliador\parecer\deletar')); ?>">
					<?php echo e(csrf_field()); ?>

					<h4><b>Parecer:</b>
						<input type="hidden" value="<?php echo e($trabalho->id); ?>" name="trabalho_id"> 
						<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
					</h4>
				</form>
			</div>	
			<?php endif; ?>

		</div>
	</div>

	<div <?= !isset($parecer->parecer) ? 'class="collapse"':'class=""' ?>  id="NewParecer">
		<center>
		<form  action="/avaliador/parecer" method="post" accept-charset="utf-8" class="form-group">
			<?php echo e(csrf_field()); ?>		

			<input type="hidden" name="trabalho_id" value="<?php echo e($trabalho->id); ?>">
			<textarea data-placement="right" data-toggle="popover" title="Instruções" data-content="Quando este campo perder o foco o texto será salvo automaticamente, sendo assim para fazer alterações no parecer de avaliação basta digitar e clicar em qualquer parte da tela com o mouse" class="form-control" id="inputParecer" name="parecer" value="<?php echo e(isset($parecer->parecer) ? $parecer->parecer : ''); ?>" style="height: 250px; width: 400px;"><?php echo e(isset($parecer->parecer) ? $parecer->parecer : ''); ?></textarea>	
		</form>
		<center>
	</div>

</div>
</div><br>

<?php if($trabalho->status_avaliacao != 3): ?>
<div class="row">
	<div class="col-md-2 col-md-offset-5 col-xs-12">
		<button class="btn btn-success btn-sm col-md-12" data-toggle="modal" data-target="#confirmar">
			<span class="glyphicon glyphicon-ok"></span> Confirmar avaliação
		</button>
	</div>
</div>
<?php endif; ?>
<br>

<!--Modal de confirmação de avaliação-->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">
					<span class="glyphicon glyphicon-alert"></span> Deseja confirmar o termino da avaliação deste trabalho? <span class="glyphicon glyphicon-alert"></span>
				</h4>
			</div>
			<div class="modal-body">
				<p>Ao clicar em sim, não será possivel refazer a avaliação, por isso verifique se todas as informações estão corretas.</p>
			</div>
			<div class="modal-footer">
				<div class="col-md-1 col-md-offset-1">
					<form method="post" action="\avaliador\concluirAvaliacao">
						<?php echo e(csrf_field()); ?>

					<input type="hidden" name="trabalho_id" value="<?php echo e($trabalho->id); ?>" name="">	
					<button type="submit" class="btn btn-success">Sim</button>
					</form>
				</div>
				<div class="col-md-1 col-md-offset-7">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para os criterios -->
<?php $__currentLoopData = $Criterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="<?php echo e($criterio->id); ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center"><?php echo e($criterio->nome); ?></h4>
			</div>
			<div class="modal-body">
				<p class="text text-center"><?php echo e($criterio->descricao); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?>

<style type="text/css">
.modal-backdrop {z-index: -1;}
</style>

<script type="text/javascript">
	$(document).on('blur','.inputNota', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});

	$(document).on('blur','#inputParecer', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});
	

	$(document).ready(function(){
	    $('[data-toggle="popover"]').popover(); 
	});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("/usuarios/avaliadores/header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>