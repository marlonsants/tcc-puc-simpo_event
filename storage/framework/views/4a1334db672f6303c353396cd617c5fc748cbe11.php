<?php $__env->startSection("conteudo"); ?>
<!-- Total de autores -->
<div class="row">
	<div class="container-fluid">

		<!-- Total de autores -->
		<div class="col-xs-12 col-md-3 ">
			<div class="col-xs-2 col-md-2 caixa-grafico fundo-verde sombra">
				<h4><span class="glyphicon glyphicon-user letra-verde col-xs-offset-1 col-md-offset-3 caixa-icone"> </span></h4> 
			</div>		
			<div class="col-xs-10 col-md-10 caixa-grafico text-center letra-verde">
				<h4>Total de Autores Cadastrados</h4>
				<hr>
				<h3><?php echo e(isset($qtdAutores) ? $qtdAutores : 0); ?></h3>
			</div>		
		</div>

		<!-- Total de Avaliadores -->
		<div class="col-xs-12 col-md-3 ">
			<div class=" col-xs-2 col-md-2 caixa-grafico fundo-amarelo sombra">
			<h4><span class="glyphicon glyphicon-user letra-amarelo col-xs-offset-1 col-md-offset-3 caixa-icone"> </span></h4> 
			</div>		
			<div class="col-xs-10 col-md-10 caixa-grafico text-center letra-amarelo">
				<h4>Total de Avaliadores Cadastrados</h4>
				<hr>
				<h3><?php echo e(isset($qtdAvaliadores) ? $qtdAvaliadores : 0); ?></h3>
			</div>		
		</div>

		<!-- Total de Trabalhos Cadastrados-->
		<div class="col-xs-12 col-md-3 ">
			<div class="col-xs-2 col-md-2 caixa-grafico fundo-vermelho sombra">
				<h4><span class="glyphicon glyphicon-user letra-vermelho col-xs-offset-1 col-md-offset-3 caixa-icone"> </span></h4> 
			</div>		
			<div class="col-xs-10  col-md-10 caixa-grafico text-center letra-vermelho">
				<h4>Total de Trabalhos Cadastrados</h4>
				<hr>
				<h3><?php echo e(isset($qtdTrabalhos) ? $qtdTrabalhos : 0); ?></h3>
			</div>	
		</div>

		<!-- Total de Trabalhos submetidos -->
		<div class="col-xs-12 col-md-3 ">
			<div class="col-xs-2 col-md-2 caixa-grafico fundo-azul sombra">
				<h4><span class="glyphicon glyphicon-user letra-azul col-xs-offset-1 col-md-offset-3 caixa-icone"> </span></h4> 
			</div>		
			<div class="col-xs-10  col-md-10 caixa-grafico text-center letra-azul">
				<h4>Total de Trabalhos Submetidos</h4>
				<hr>
				<h3><?php echo e(isset($qtdTotal) ? $qtdTotal : 0); ?></h3>
			</div>	
		</div>
	</div>
</div>

<?php echo Charts::assets(); ?>


<div class="row" style="margin-top: 60px">
    <div class="col-md-8 col-md-offset-2">
        <?php echo $chart->render(); ?>     
    </div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-2 col-xs-6">
		<b>Trabalhos Avaliados: <?php echo e(isset($qtd) ? $qtd : 0); ?></b>
	</div>
	<div class="col-md-4 col-xs-6" style="text-align: right;">
		<b>Trabalhos Submetidos: <?php echo e(isset($qtdTotal) ? $qtdTotal : 0); ?></b>
	</div>
</div>

<center class="row" style="margin-top: 80px">
	<div class="col-md-3">
		<?php echo $chart2->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart3->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart4->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart5->render(); ?> 
	</div>
</center><hr>

<center class="row">
	<div class="col-md-3">
		<?php echo $chart6->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart7->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart8->render(); ?> 
	</div>
	<div class="col-md-3">
		<?php echo $chart9->render(); ?> 
	</div>
</center><hr>

<div class="row" style="margin-top: 80px">
	<div class="col-md-6">
		<?php echo $chart10->render(); ?> 
	</div>
	<div class="col-md-6">
		<?php echo $chart11->render(); ?> 
	</div>
</div><hr>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>