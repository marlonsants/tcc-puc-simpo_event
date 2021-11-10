<?php $__env->startSection("conteudo"); ?>
<div class="row">
	<h3 class="text-center text-info">Cadastre as Categorias de Trabalhos</h3><hr>
	<div class="col-md-12 ">
		<form action="/administrador/cadastros_basicos/categorias/add" method="post" accept-charset="utf-8" class="form-group">
			<?php echo csrf_field(); ?>

			<div class="row">
				<div class="col-md-4 col-md-offset-3">
					<input type="text" name="nome" placeholder="Nome" class="form-control">
				</div>
				<!-- <div class="col-md-1 ">
					<input type="color" name="cor" placeholder="cor" class="form-control">
				</div> -->
				<div class="col-md-1">	
					<input type="submit" name="escolher" value="salvar" class="btn btn-info form-control ">
				</div>
			</div>		
		</form>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<?php if(count($Categorias)>0): ?>
		<table class="table table-bordered table-responsive table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th>Descrição</th>
					<!-- <th>Cor</th> -->
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $Categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<td><?php echo e($categoria->nome); ?></td>
					<td>
						<button title="Editar" class="btn btn-sm btn-info" data-toggle="collapse" data-target="#edit<?php echo e($categoria->id); ?>" data-placement="left"><span class="glyphicon glyphicon-pencil"></span></button>
						<form action="/administrador/cadastros_basicos/categorias/delete" method="post" style="display:inline;">
							<?php echo csrf_field(); ?>

							<input type="hidden" name="id" value="<?php echo e($categoria->id); ?>">
							<button class="btn btn-sm btn-danger" type="submit"><span class="glyphicon glyphicon-trash"/></button>
						</form>
					</td>
				</tr>

				<tr id="edit<?php echo e($categoria->id); ?>" class="collapse">
					<td colspan="3">
						<form action="/administrador/cadastros_basicos/categorias/update" method="post" accept-charset="utf-8" class="form-group">
							<div class="col-md-12">
								<?php echo csrf_field(); ?>

								<div class="row"><input type="hidden" name="id" value="<?php echo e($categoria->id); ?>"></div>
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="nome" placeholder="Nome" class="form-control" value="<?php echo e($categoria->nome); ?>">
									</div>

									<div class="col-md-3">	
										<input type="submit" name="escolher" value="salvar" class="btn btn-info form-control">
									</div>
								</div>		
							</div>
						</form>
					</td>
				</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</tbody>
		</table>
		<?php else: ?>
		<alert class="alert alert-info col-md-12 text-center">Não há informações</alert>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	$('#categoria').addClass('active');
</script>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>