<?php $__env->startSection('conteudo'); ?>
<body class="body-cinza">

<div class="row">
	<div class="col-md-10 col-md-offset-1 box-login">
		<div class="panel panel-default panel-body borda-0px sombra">	
		<div class="text-center">
			<div class="row"><div class="legenda">Clique no evento que deseja acessar</div></div>
			<div class="col-md-12">
				<?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>	
					<div class="col-md-3">  
						<div	class="panel panel-default" style="margin-left: 10px;margin-top:50px;">
							<div class="panel panel-body" style="padding: 10px; margin:0px,0px,0px,10px;height: 150px">
								<a href="/escolher_evento/<?php echo e($evento->id); ?>">
									<img class="img-thumbnail" style="display: block; margin-left: auto; margin-right: auto; height:150px" src="<?php echo e(URL::asset('images')); ?>/logoDosEventos/<?php echo e($evento->logo_id); ?>"> 
								</a>		
							</div>	
							<div class="panel panel-footer" style="height: 30px">
								<a href="/escolher_evento/<?php echo e($evento->id); ?>" style="color: black">
									<strong><?php echo e($evento->nome_evento); ?></strong>
								</a>
							</div>
						 	
						</div>
					</div>	
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</div>
			<!-- <form action="/escolher_evento" method="post" accept-charset="utf-8" class="form-group">
				<?php echo csrf_field(); ?>

				<select class="form-control" name="evento_id">	
					<?php if(isset($eventos) and count($eventos) > 0): ?>
					<?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>					
					<option value="<?php echo e($evento->id); ?>"><?php echo e($evento->nome_evento); ?> - <?php echo e($evento->instituicao); ?></option>}}
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<?php else: ?>
					<option value="0">Não existe Eventos Cadastrados</option>	
					<?php endif; ?>
				</select>		
				<input type="submit" name="escolher" value="Escolher Evento" class="btn btn-info form-control">
			</form> -->
		</div>

	</div>
	<script type="text/javascript">
		$('#selecionaevento').addClass('active');
	</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('usuarios/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>