<?php $__env->startSection("conteudo"); ?>

<div class="container">

	<?php if(!isset($administradores[0]->id)): ?>
	<form action="/administrador/cadastrar/novo" method="post">		
	<?php else: ?>
	<form action="/administrador/editar/permissao" method="post">		
	<?php endif; ?>	
		<?php echo csrf_field(); ?>

		<?php if(!isset($permissoes)): ?>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<input required type="email" class="form-control" name="e_mail" placeholder="Digite o E-mail do Administrador a ser cadastrado" data-placement="top" data-toggle="popover" title="Instruções" data-content="A pessoa escolhida já deve estar previamente cadastrada no sistema para confirmação dos dados.">
			</div>
		</div>
		<?php elseif(isset($administradores[0]->id)): ?>

			<div class="col-md-6 col-md-offset-3">
				<select id="selectAdmin" required type="email" class="form-control" name="pessoa_id"  data-placement="top" data-toggle="popover" title="Instruções" data-content="Selecione o avaliador faça as alterações de suas permissões e clique em salvar">
				<?php $__empty_1 = true; $__currentLoopData = $administradores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
					
					<option value="<?php echo e($admin->id); ?>"><?php echo e($admin->nome); ?></option>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
					<option>Nenhum avaliador cadastrado até o momento</option>
				<?php endif; ?>	
				</select>	
			</div>

		<?php endif; ?>
		<div class="row" >
			<center class="col-md-4 col-md-offset-4" id="tabelaPermissoes">
				<h4>Permissões do administrador</h4>
				<table class="table table-bordered table-responsive table-condensed table-striped" style="text-align: left;">
					<tr><td><b>Autores</b></td><td><input type="checkbox" id="p1" <?php if(isset($permissoes)){if(in_array(1,$permissoes)){echo 'checked="true"'; } } ?> name="autores"></td></tr>
					<tr><td><b>Trabalhos</b></td><td><input type="checkbox" id="p2" <?php if(isset($permissoes)){if(in_array(2,$permissoes)){echo 'checked="true"'; } } ?>  name="trabalhos"></td></tr>
					<tr><td><b>Avaliadores</b></td><td><input type="checkbox" id="p3" <?php if(isset($permissoes)){if(in_array(3,$permissoes)){echo 'checked="true"'; } } ?> name="avaliadores"></td></tr>
					<tr><td><b>Cadastros</b></td><td><input type="checkbox" id="p4" <?php if(isset($permissoes)){if(in_array(4,$permissoes)){echo 'checked="true"'; } } ?>  name="cadastros"></td></tr>
					<tr><td><b>Pré Avaliador</b></td><td><input type="checkbox" id="p6" <?php if(isset($permissoes)){if(in_array(6,$permissoes)){echo 'checked="true"'; } } ?> name="pre_avaliador"></td></tr>
				</table>

					<button type="submit" class="btn btn-primary" style="margin-top: 5px;"><span class="glyphicon glyphicon-floppy-save" /> Salvar </button>
				
			</center>
		</div>
		<br>
				
	</form><br>

	<?php if(session()->has('msg')): ?>
	<div class="row" id="msg_suc">
		<div class='alert alert-success text-center msg_error col-md-6 col-md-offset-3'><?php echo e(session('msg')); ?></div>
	</div>
	<?php endif; ?>

	<?php if(session()->has('msg_erro')): ?>
	<div class="row">
		<div class='alert alert-danger text-center msg_error col-md-6 col-md-offset-3'><?php echo e(session('msg_erro')); ?></div>
	</div>
	<?php endif; ?>

</div>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change','#selectAdmin',function(){
		console.log('teste');
		data = {};
		data.admin_id = $('#selectAdmin option:selected').val();
		data._token = $("input[name*='_token']").val();
		$.ajax({
			type: "POST",
			url: '/administrador/buscar/permissao',
			data: data,
			dataType: 'json',
			success: function(data){
				
				console.log(data);
				$("input[type=checkbox]").prop('checked',false);
				$('#msg_suc').html(' ');
				
				if(jQuery.inArray(1,data) !== -1){
					$("#p1").prop('checked',true);
				}

				if(jQuery.inArray(2,data) != -1){
					$("#p2").prop('checked',true);
				}

				if(jQuery.inArray(3,data) != -1){
					$("#p3").prop('checked',true);
				}

				if(jQuery.inArray(4,data) != -1){
					$("#p4").prop('checked',true);
				}

				if(jQuery.inArray(6,data) != -1){
					$("#p6").prop('checked',true);
				}
				
			},
			error: function(data){
				console.log('Erro ao buscar.');
			}
		});
	});	
});


</script>


	<!-- var tabela = '<table class="table table-bordered table-responsive table-condensed table-striped" style="text-align: left;">'+
					'<tr><td><b>Autores</b></td><td><input type="checkbox" name="autores"></td></tr>'+
					'<tr><td><b>Trabalhos</b></td><td><input type="checkbox" name="trabalhos"></td></tr>'+
					'<tr><td><b>Avaliadores</b></td><td><input type="checkbox" name="avaliadores"></td></tr>'+
					'<tr><td><b>Cadastros</b></td><td><input type="checkbox" name="cadastros"></td></tr>'+
					'<tr><td><b>Pré Avaliador</b></td><td><input type="checkbox" name="pre_avaliador"></td></tr>'+
				'</table>';	 -->		



<?php $__env->stopSection(); ?>  
<?php echo $__env->make('/usuarios/administradores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>