<?php $__env->startSection("conteudo"); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="/js/uploadLogo.js"></script>
<?php $__env->stopPush(); ?>
<div class="row">
	<div class="col-md-12">
	<?php if(Session::has('msg')): ?>
	<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('msg')); ?></b></p></div>
	<?php endif; ?>	
	<?php if(Session::has('erro')): ?>
	<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('erro')); ?></b></p></div>
	<?php endif; ?>	
		<h3 class="text-center  text-info">Informações do Evento </h3>
		<hr>
		 <?php if(isset($evento)): ?>
		    <form id="formEvento" action="<?php echo e(url('administrador/editar/evento', $evento->id)); ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		    <?php echo method_field('PUT'); ?>

	    <?php else: ?>
		<form id="formEvento" action="/administrador/eventos/novo/cadastrar" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-group">
		<?php endif; ?>	
			<?php echo csrf_field(); ?>

			
			<div class="col-md-12">

				<div class="row">
					
					<div class="col-md-4">
						<label>Nome do evento</label>
						<input type="text" value="<?php echo e(isset($evento->nome_evento) ? $evento->nome_evento : old('nome_evento')); ?>" name="nome_evento" placeholder="Nome do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Instituição</label>
						<input type="text" value="<?php echo e(isset($evento->instituicao) ? $evento->instituicao : old('instituicao')); ?>" name="instituicao" placeholder="Instituição do Evento" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Endereço de realização</label>
						<input type="text" value="<?php echo e(isset($evento->local_evento) ? $evento->local_evento : old('local_evento')); ?>" name="local_evento" placeholder="Endereço completo do Evento" class="form-control">
					</div>
				</div>

				<div class="row">	
					
					<div class="col-md-4">	
						<label>Logo do evento</label>
						<div class="panel panel-default">
							<div class="panel panel-body">
								<?php if(isset($evento->logo_id) && $evento->logo_id != null ): ?>
									<img id="imgLogoEvento" style=" min-width:150px; min-height:100px; max-width:150px; max-height:100px; width: auto; height: auto;" class="img-responsive"  src="<?php echo e(asset('images/logoDosEventos/'.$evento->logo_id)); ?>" >
									
									
									
								
								<?php endif; ?>	
							</div>
							<div class="panel panel-footer" style="height: 50px">
								<input class="btn btn-info form-control" type="file" id="logoEvento"  name="logoEvento">		
							</div>
								
								
										
						</div>	
						
					</div>

					<div class="col-md-8">	
						<label>Tema</label>		
						<textarea style="min-height:150px; height: auto;" name="tema" placeholder="Tema do Evento" class="form-control" rows="5"><?php echo e(isset($evento->tema) ? $evento->tema : old('tema')); ?></textarea>
					</div>

				</div>

			</div>

			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info ">Regras</h3>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<label>Máximo de trabalhos por autor</label>
						<input type="number" value="<?php echo e(isset($evento->num_trab_autor) ? $evento->num_trab_autor : old('num_trab_autor')); ?>" name="num_trab_autor" placeholder="Máximo de Trabalhos por Autor" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de autores por trabalho</label>
						<input type="number" value="<?php echo e(isset($evento->max_autores) ? $evento->max_autores : old('max_autores')); ?>" name="max_autores" placeholder="Máximo de autores por Trabalho" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Máximo de trabalhos por avaliador</label>
						<input type="number" value="<?php echo e(isset($evento->num_trab_avaliador) ? $evento->num_trab_avaliador : old('num_trab_avaliador')); ?>" name="num_trab_avaliador" placeholder="Máximo de trabalhos por Avaliador" class="form-control">
					</div>

					<div class="col-md-6">
						<label>Máximo de avaliadores por trabalho</label>
						<input type="number" value="<?php echo e(isset($evento->max_avaliadores_trabalhos) ? $evento->max_avaliadores_trabalhos : old('max_avaliadores_trabalhos')); ?>" name="max_avaliadores_trabalhos" placeholder="Máximo de avaliadores por trabalho" class="form-control">
					</div>
					<div class="col-md-6">
						<label>Nota maxima do trabalho</label>
						<input value="<?php echo e(isset($evento->max_nota_trabalhos) ? $evento->max_nota_trabalhos : old('max_nota_trabalhos')); ?>" type="number" name="max_nota_trabalhos" placeholder="Nota maxima do trabalho" class="form-control">
					</div>				
				</div>
			</div>


			<div class="col-md-12">
				<br><h3 class="text-center margin-top-20 text-info">Datas</h3>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Submissões</label>
						<input type="date" value="<?php echo e(isset($evento->inicio_submissao) ? $evento->inicio_submissao : old('inicio_submissao')); ?>" name="inicio_submissao" placeholder="Início das Submissões" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Submissões</label>
						<input type="date" value="<?php echo e(isset($evento->fim_submissao) ? $evento->fim_submissao : old('fim_submissao')); ?>" name="fim_submissao" placeholder="Fim das Submissões" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Início das Avaliações</label>
						<input type="date" value="<?php echo e(isset($evento->inicio_avaliacoes) ? $evento->inicio_avaliacoes : old('inicio_avaliacoes')); ?>" name="inicio_avaliacoes" placeholder="Início das Avaliações" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Avaliações</label>
						<input type="date" value="<?php echo e(isset($evento->fim_avaliacoes) ? $evento->fim_avaliacoes : old('fim_avaliacoes')); ?>" name="fim_avaliacoes" placeholder="Fim das Avaliações" class="form-control">
					</div>					
				</div>
			</div>

			<div class="col-md-12 margin-top-20">
				<div class="row">
					<div class="col-md-3">
						<label for="">Início das Incrições</label>
						<input type="date" value="<?php echo e(isset($evento->inicio_inscricoes) ? $evento->inicio_inscricoes : old('inicio_inscricoes')); ?>" name="inicio_inscricoes" placeholder="Início das Incrições" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim das Incrições</label>
						<input type="date" value="<?php echo e(isset($evento->fim_inscricoes) ? $evento->fim_inscricoes : old('fim_inscricoes')); ?>" name="fim_inscricoes" placeholder="Fim das Incrições" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Início do Evento</label>
						<input type="date" value="<?php echo e(isset($evento->inicio_evento) ? $evento->inicio_evento : old('inicio_evento')); ?>" name="inicio_evento" placeholder="Início do Evento" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="">Fim do Evento</label>
						<input type="date" value="<?php echo e(isset($evento->fim_evento) ? $evento->fim_evento : old('fim_evento')); ?>" name="fim_evento" placeholder="Fim do Evento" class="form-control">
					</div>
				</div>
			</div>

			<div class="col-md-6 col-md-offset-3 margin-top-20">
				<input type="submit" name="cadastrar" class="btn btn-info form-control" value="Cadastrar">	
			</div>
		</form>
	</div>
</div><br>

<script type="text/javascript">
  $('#novoevento').addClass('active');
  $('#formEvento').submit(function(){
  	window.location.reload(true);
  });
  
  
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>