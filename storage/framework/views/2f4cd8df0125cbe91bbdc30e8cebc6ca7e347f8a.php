<?php $__env->startSection("conteudo"); ?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 box-login">	
		<div class="text-center">
			<h3>Antes de começar selecione um de seus eventos cadastrados.</h3>
			<form action="/administrador/escolherevento" method="post" accept-charset="utf-8" class="form-group">
			<?php echo csrf_field(); ?>

				<select name="evento_id" class="form-control">
					<?php if(isset($eventos) and count($eventos) > 0): ?>
					<?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>					
					<option value="<?php echo e($evento->id); ?>"><?php echo e($evento->nome_evento); ?> - <?php echo e($evento->tema); ?></option>}}
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<?php else: ?>
					<option value="0">Não existe Eventos Cadastrados</option>	
					<?php endif; ?>
				</select>		
				<input type="submit" name="escolher" value="Escolher Evento" class="btn btn-info form-control">
			</form>
		</div>

	</div>
<script type="text/javascript">
  $('#selecionaevento').addClass('active');
</script>
</div>
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>