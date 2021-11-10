<?php $__env->startSection("conteudo"); ?>
<div class="row">
	<h3 class="text-center text-info">Cadastre os critérios de avaliação</h3><hr>
	<div class="col-md-10 col-md-offset-1">
		<form action="/administrador/cadastros_basicos/criterios/add" method="post" accept-charset="utf-8" class="form-group">
			<?php echo csrf_field(); ?>

			<div class="row">
				<div class="col-md-4">
					<input type="text" name="nome" placeholder="Nome" class="form-control">	
				</div>
				<div class="col-md-5">
				<input type="text" name="descricao" placeholder="Descreva o modo de avaliação" class="form-control">	
				</div>

				<div class="col-md-2">
					<input type="number" name="peso" placeholder="Peso" class="form-control">
				</div>
				<div class="col-md-1">	
					<input type="submit" name="escolher" value="salvar" class="btn btn-info form-control ">
				</div>
			</div>		
		</form>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Peso</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $Criterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<td><?php echo e($criterio->nome); ?></td>
					<td><?php echo e($criterio->peso); ?></td>
					<td>
						<button title="Descrição" data-toggle="modal" data-target="#desc<?php echo e($criterio->id); ?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-eye-open"></span></button>

						<button title="Editar" class="btn btn-sm btn-info" data-toggle="collapse" data-target="#edit<?php echo e($criterio->id); ?>" data-placement="left"><span class="glyphicon glyphicon-pencil"></span></button>

						<form action="/administrador/cadastros_basicos/criterios/delete" method="post" style="display:inline;">
							<?php echo csrf_field(); ?>

							<input type="hidden" name="id" value="<?php echo e($criterio->id); ?>">
							<button class="btn btn-sm btn-danger" type="submit"><span class="glyphicon glyphicon-trash"/></button>
						</form>
					</td>
				</tr>

				<tr id="edit<?php echo e($criterio->id); ?>" class="collapse">
					<td colspan="3">
						<form action="/administrador/cadastros_basicos/criterios/update" method="post" accept-charset="utf-8" class="form-group">
							<div class="col-md-12">
							<?php echo csrf_field(); ?>

								<input type="hidden" name="id" value="<?php echo e($criterio->id); ?>">
								<div class="col-md-4">
									<input type="text" name="nome" placeholder="Nome" class="form-control" value="<?php echo e($criterio->nome); ?>">	
								</div>
								<div class="col-md-5">
									<input type="text" name="descricao" placeholder="Descreva o modo de avaliação" class="form-control" value="<?php echo e($criterio->descricao); ?>">	
								</div>

								<div class="col-md-2">
									<input type="text" name="peso" placeholder="Peso" class="form-control" value="<?php echo e($criterio->peso); ?>">
								</div>
								<div class="col-md-1">	
									<input type="submit" name="escolher" value="salvar" class="btn btn-info form-control ">
								</div>
							</div>
						</form>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</tbody>
		</table>
	</div>
</div>

<?php $__currentLoopData = $Criterios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<!-- Modal -->
<div id="desc<?php echo e($criterio->id); ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title">Detalhes do critério</h4>
	</div>
	<div class="modal-body">
		<p><?php echo e($criterio->descricao); ?></p>
	</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>

	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<style type="text/css">.modal-backdrop {z-index: -1;}</style>

<script type="text/javascript">
	$('#criterios').addClass('active');
</script>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>