<?php $__env->startSection('conteudo'); ?>

	<?php if(Session::has('msg')): ?>
		<div class="alert alert-danger text-center"><p><b><?php echo e(Session::get('msg')); ?></b></p></div>
	<?php endif; ?>

	<?php if(Session::has('suc')): ?>
		<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('suc')); ?></b></p></div>
	<?php endif; ?>

<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
	<caption class="text-center">Listagem de Trabalhos</caption>
	<thead>
		<tr class="text-center">
			<th>Título</th>
			<th>Área</th>
			<th>Categoria</th>
			<th>Status</th>
			<th>Média</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php $__empty_1 = true; $__currentLoopData = $trabalhos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabalho): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?> 
		<tr>
			<td><?php echo e($trabalho->titulo); ?></td>
			<td><?php echo e($trabalho->area); ?></td>
			<td><?php echo e($trabalho->categoria); ?></td>
			<td><?php echo e($trabalho->status_avaliacao); ?></td>
			<td style="font-size: 20px;"><b class="text-success"><?php echo e(number_format($trabalho->notaFinal, 2)); ?> </b></td>	
			<td>
				<a href="/avaliador/trabalhos/avaliar/<?php echo e($trabalho->id); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Avaliar Trabalho"><span class="glyphicon glyphicon-search"></span></a>
			</td>
		</tr>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
		<td>
		<h3>Nenhum trabalho atribuido</h3>
		</td>
		<?php endif; ?>

	</tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("/usuarios/avaliadores/header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>