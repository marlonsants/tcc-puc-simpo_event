<?php $__env->startSection('conteudo'); ?>

<body class="body-cinza">
<div class="row">
	<?php if(Session::has('msg')): ?>
		<div class="alert alert-danger text-center"><p><b><?php echo e(Session::get('msg')); ?></b></p></div>
	<?php endif; ?>

	<?php if(Session::has('suc')): ?>
		<div class="alert alert-danger text-center"><p><b><?php echo e(Session::get('suc')); ?></b></p></div>
	<?php endif; ?>
	<div class="col-md-12">
		<div class="panel panel-default panel-body borda-0px sombra">

			<?php if($arrayDatas['dataAtual'] >= $arrayDatas['data_ini_sub']): ?>
				<?php if($possuiAcesso == true): ?>
					<div class="alert alert-info text-center">
						<h4>Para alterar o seu tipo de acesso selecione uma das opções e clique em continuar</h4>
					</div>

				<?php else: ?>
					<div class="alert alert-info">
						<h3>Olá <?php echo e($nome_pessoa[0]['nome']); ?>, você selecionou o evento <?php echo e($evento->nome_evento); ?><br>
						Tema do Evento: <?php echo e($evento->tema); ?>, como esta é a primeira vez que esta acessando este evento, antes de continuar você precisa definir seu tipo de usuário</h3>

						<h3>Os tipos são:</h3>
						<h4>Autor: Tem permissão somente pra submeter trabalhos e acompanhar o status de avaliação e resultados dos mesmos, para saber mais leia o manual de submissão no menu após acessar o sistema.</h4>
						<h4>Avaliador: Ao definir o tipo de usuário como avaliador você estará se candidatando a participar da banca de avaliação de trabalhos deste evento, contudo os privilégios de avalaidor só serão liberados quando a comissão organizadora do evento aprovar sua candidatura, para que seja aprovada a comissão ira certificar se seus dados são integros e se o seu perfil profissional é adequando pra assumir esse cargo, se sua candidatura não for aprovada seu nivel de acesso será  automatiamente convertido para autor</h4>
					</div>
				<?php endif; ?>

				<div class="col-md-8 col-md-offset-2">	
					<div class="text-center">
						<?php if($possuiAcesso == true): ?>
							<form class="form" action="autor/acesso/update" method="post">
						<?php else: ?>
							<form class="form" action="/sistema" method="post">
						<?php endif; ?>	
							<?php echo csrf_field(); ?>

							<div class="col-md-offset-2 col-md-8">
								<select id="acesso_id" name="acesso_id" class="form-control">
									<?php $__empty_1 = true; $__currentLoopData = $acessos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acesso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
										<?php if($acesso->id != 3 and $acesso->id != 4): ?>
										<option value="<?php echo e($acesso->id); ?>"><?php echo e($acesso->descricao); ?></option>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
									<h5>Niveis de acesso não cadastrado</h5>
									<?php endif; ?>
								</select>
								<label id="label" style="display:none">Selecione a área temática que deseja se canditar pra avaliar</label>
								<select id="area" name="area" class="form-control" style="display:none">
									<?php $__empty_1 = true; $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
									<option value="<?php echo e($area->id); ?>"><?php echo e($area->nome); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
									<h5>Areas não cadastradas</h5>
									<?php endif; ?>
								</select>
								<a href="javascript:window.history.go(-1)" class="btn btn-warning form-control" value="Voltar">Voltar</a>
								<input type="submit" name="escolher" value="Continuar" class="btn btn-info form-control">
							</div>
						</form>

					</div>
				</div>

				<script type="text/javascript">
					$('#selecionaevento').addClass('active');
					selectAvaliador();
				</script>
			<?php else: ?>
				<div class="text-center">
					
					<div class="alert alert-info">
						<h3>Olá <?php echo e($nome_pessoa[0]['nome']); ?> as submissões de trabalhos para este evento ainda não iniciaram, de acordo com o cronograma do evento irá inciar na seguinte data <?php echo e($arrayDatas['data_ini_sub_br']); ?></h3>
						<h3>O acesso ao sistema só será concedido a partir da data informada, aproveite este tempo pra revisar e melhorar o seu trabalho</h3>
						<h3>Agradecemos a compreensão !</h3>
						<a class="btn btn-primary" href="/eventos"> Escolher outro evento</a>
					</div>
					
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('usuarios/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>