<?php 
use App\Model\Evento;

	$maxAutores = Evento::maxAutores();

 ?>
<?php $__env->startPush('mask'); ?>
<script type="text/javascript" src="/js/mask/jquery.mask.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('conteudo'); ?> 
<div class="row">

	<?php if(Session::has('msg')): ?>
	<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('msg')); ?></b></p></div>
	<?php endif; ?>	
	<?php if(Session::has('erro')): ?>
	<div class="alert alert-success text-center"><p><b><?php echo e(Session::get('erro')); ?></b></p></div>
	<?php endif; ?>	

	<div class="container-fluid col-xs-12 col-md-10 col-md-offset-1">
		<?php if(isset($trabalho)): ?>
		<form action="<?php echo e(url('autor/trabalhos/editarTrabalho',$trabalho->id)); ?>" method="POST" accept-charset="utf-8" class="form-group" 
		oninput="texto = resumo.value.substr(0, 2500);resumo.value.length <= 2500 ? qr.value = resumo.value.length : qrm.value ='Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto';  resumo.value=texto;  
		textoT = titulo.value.substr(0, 200);titulo.value.length <= 200 ? qt.value = titulo.value.length : qtm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; titulo.value=textoT;  
		textoP = palavra_chave.value.substr(0, 200);palavra_chave.value.length <= 200 ? qp.value = palavra_chave.value.length : qpm.value='Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; palavra_chave.value=textoP;   
		textoA = abstract.value.substr(0, 2500);abstract.value.length <= 2500 ? qa.value = abstract.value.length : qam.value = 'Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; abstract.value=textoA;    
		textoK = key_word.value.substr(0, 200);key_word.value.length <= 200 ? qk.value = key_word.value.length : qkm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; key_word.value=textoK; ">	
		<?php echo method_field('PUT'); ?>	
		<?php else: ?>
		<form action="<?php echo e(url('autor/cadastrar/trabalho')); ?>" method="POST" accept-charset="utf-8" class="form-group" 
		oninput="texto = resumo.value.substr(0, 2500);resumo.value.length <= 2500 ? qr.value = resumo.value.length : qrm.value ='Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto';  resumo.value=texto;  
		textoT = titulo.value.substr(0, 200);titulo.value.length <= 200 ? qt.value = titulo.value.length : qtm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; titulo.value=textoT;  
		textoP = palavra_chave.value.substr(0, 200);palavra_chave.value.length <= 200 ? qp.value = palavra_chave.value.length : qpm.value='Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; palavra_chave.value=textoP;   
		textoA = abstract.value.substr(0, 2500);abstract.value.length <= 2500 ? qa.value = abstract.value.length : qam.value = 'Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; abstract.value=textoA;    
		textoK = key_word.value.substr(0, 200);key_word.value.length <= 200 ? qk.value = key_word.value.length : qkm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; key_word.value=textoK; ">
		<?php endif; ?>
		
			<?php echo csrf_field(); ?>

			<div id="Autores">
				<input type="hidden" id="AutorLogado" value="<?php echo e(Session('id')); ?>" >
				<?php if(isset($autores)): ?>

					<?php $__currentLoopData = $autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<div id="divAutor<?php echo e($autor->id); ?>">
							<input id="idAutor<?php echo e($autor->id); ?>" class="idAutor" type="hidden"  name="autores[autor<?php echo e($autor->id); ?>][id]" value="<?php echo e($autor->id); ?>">
							<input id="ordemAutor<?php echo e($autor->id); ?>" class="ordemAutor" type="hidden"  name="autores[autor<?php echo e($autor->id); ?>][ordem]" value="<?php echo e($autor->ordemDeAutoria); ?>">
							<input id="AutorId<?php echo e($autor->id); ?>" class="autor_id" type="hidden"  name="autores[autor<?php echo e($autor->id); ?>][autor_id]" value="<?php echo e($autor->autor_id); ?>">
						</div>				
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							
				<?php else: ?> 
					<div id="divAutor<?php echo e(Session('id')); ?>">
						<input id="idAutor<?php echo e(Session('id')); ?>" class="idAutor" type="hidden"  name="autores[autor<?php echo e(Session('id')); ?>][id]" value="<?php echo e(Session('id')); ?>">
						<input id="ordemAutor<?php echo e(Session('id')); ?>" class="ordemAutor" type="hidden"  name="autores[autor<?php echo e(Session('id')); ?>][ordem]" value="1">
					</div>			
				<?php endif; ?>

				
				
			</div>
						
			<div class="row">
				<div class="col-xs-12 col-md-12 form-group">
					<label>Título</label>
					<output class="text-danger" name="qtm"></output>
					<input required type="tex" name="titulo"  class="form-control" placeholder="Título do Artigo" value="<?php echo e(isset($trabalho->titulo) ? $trabalho->titulo : old('titulo')); ?>" style="text-align: left;">
					<output name="qt">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-6 form-group">
					<label>Resumo</label>
					<output name="qrm" class="text-danger"></output>
					<textarea required name="resumo" class="form-control"  placeholder="Resumo do Artigo" style="width: 100%; height: 20%;"><?php echo e(isset($trabalho->resumo) ? $trabalho->resumo : old('resumo')); ?></textarea>
					<output name="qr">0</output>
				</div>

				<div class="col-xs-12 col-md-6 form-group">
					<label>Abstract</label>
					<output name="qam" class="text-danger"></output>
					<textarea required name="abstract" class="form-control" placeholder="Abstract" style="width: 100%; height: 20%;"><?php echo e(isset($trabalho->abstract) ? $trabalho->abstract : old('abstract')); ?></textarea>
					<output name="qa">0</output>
				</div>
			
				
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-6 form-group">
					<label>Palavras-chaves</label>
					<output name="qpm" class="text-danger"></output>
					<textarea required name="palavra_chave" class="form-control"  placeholder="Palavras-chave" style="width: 100%;"><?php echo e(isset($trabalho->palavra_chave) ? $trabalho->palavra_chave : old('palavra_chave')); ?></textarea>
					<output name="qp">0</output>
				</div>
			
				<div class="col-xs-12 col-md-6 form-group">
					<label>Key Words</label>
					<output name="qkm" class="text-danger"></output>
					<textarea required name="key_word" class="form-control"   placeholder="Key-words" style="width: 100%;"><?php echo e(isset($trabalho->key_word) ? $trabalho->key_word : old('key_word')); ?></textarea>
					<output name="qk">0</output>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-4 form-group">
					<label>Categoria</label>
					<select name="categoria_id"  class="form-control" required>
						<?php if(isset($trabalho)): ?>
							<option selected value="<?php echo e($trabalho->categoria_id); ?>"><?php echo e($trabalho->categoria); ?></option>
						<?php endif; ?>
						<?php $__empty_1 = true; $__currentLoopData = $categoria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorias): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
						<option value="<?php echo e($categorias->id); ?> "><?php echo e($categorias['nome']); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
						<option></option>
						<?php endif; ?>
					</select>
				</div>

				<div class="col-xs-12 col-md-4 form-group">
					<label>Area</label>
					<select name="area_id"  class="form-control" required>
						<?php if(isset($trabalho)): ?>
							<option selected value="<?php echo e($trabalho->area_id); ?>"><?php echo e($trabalho->area); ?></option>
						<?php endif; ?>
						<?php $__empty_1 = true; $__currentLoopData = $area; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $areas): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
						<option value="<?php echo e($areas->id); ?>"><?php echo e($areas['nome']); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
						<option></option>
						<?php endif; ?>
					</select>
				</div>


				

				
				<div id="coautoresdiv"></div>
				<!-- modal de aviso quando o coautor não está cadastrado -->
				<div id="modalMensagem" class="modal fade" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Atenção !</h4>
				      </div>
				      <div class="modal-body">
				      	<p>
				      		O coautor informado não está cadastrado no sistema !!!!!
				      	</p>
				       <p>
						Para ser coautor de um trabalho é necessário estar cadastrado no sistema, pois as informações para os anais do evento serão coletadas a partir do cadastro.
						</p>
						<p>
						Agradecemos a compreessão qualquer dúvida favor entrar em contato através do e-mail 
						<strong>system4college@gmail.com</strong>
						</p>	
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				       </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- fim do modal -->

				
			</div>

			<div class="row">
				<div class="col-md-12">
					<label>Autores do trabalho</label> <button  type="button" data-toggle="modal" data-target="#ModalAutores" class="btn-sm btn-info glyphicon glyphicon-plus" tool></button>	
					

					<table class="table">
						<thead style="background-color: white; color: black; font-size: 14px "> 
							<th>Nome</th><th>email</th><th>Ordem de autoria</th><th></th>
						</thead>
						<?php if(isset($autores)): ?>

							<?php $__currentLoopData = $autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<tbody style="font-size: 14px" id="tabelaDeAutores">
									<tr id="trAutor<?php echo e($autor->id); ?>">
										<td><?php echo e($autor->nome); ?></td><td><?php echo e($autor->email); ?></td><td><?php echo e($autor->ordemDeAutoria); ?>º Autor(a)</td>
										<td>
											<button id="<?php echo e($autor->id); ?>" email="<?php echo e($autor->email); ?>" nome="<?php echo e($autor->nome); ?>" ordem="<?php echo e($autor->ordemDeAutoria); ?>" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> 
											<?php if($autor->id != session('id')): ?>
											<button id="<?php echo e($autor->id); ?>" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button> 
											<?php endif; ?>
										</td>	
									</tr>
							
								</tbody>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							
						<?php else: ?> 
							<tbody style="font-size: 14px" id="tabelaDeAutores">
								<tr id="trAutor<?php echo e(session('id')); ?>">
									<td><?php echo e(Session('pessoa_nome')); ?></td><td><?php echo e(Session('email')); ?></td><td>1º Autor(a)</td>
									<td>
										<button id="<?php echo e(session('id')); ?>" email="<?php echo e(Session('email')); ?>" nome="<?php echo e(Session('pessoa_nome')); ?>" ordem="1" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> 
									</td>	
								</tr>
							
							</tbody>
						<?php endif; ?>
						
						

					</table>

				</div>
				
			</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
					<input type="submit" value="Salvar" class="form-control btn btn-info" >
				</div>		
			</div>
					

		</form>
	</div>

	<div id="ModalAutores" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			       <h4 class="modal-title">Incluir Autor !</h4>
			    </div>

			    <div class="modal-body">
			    	<input type="hidden" id="idAutor" name="idAutor" class="form-control email" >
			      	<div class="col-md-4 coautores">
			      		<input placeholder="E-mail " type="text" id="email" name="email" class="form-control email" required>
					</div>

					<div class="col-md-4" name="NomeCoautor">
						<input placeholder="nome " type="text" id="nome" name="nome" class="form-control"  readonly  required>
					</div>

					<div class="col-md-4" name="OrdemDeAutoria">

						<Select id="OrdemDeAutoria" name="OrdemDeAutoria" class="form-control"   required>
							<option value="0">Ordem de autoria</option>
							<?php for($x = 1; $x <= $maxAutores; $x++): ?>
								<option value="<?php echo e($x); ?>"><?php echo e($x); ?>º Autor(a)</option>
							<?php endfor; ?>
						</select>
			      	</div>
			    </div>	
		      <div class="modal-footer">
		      	<button class="btn btn-info" id="SalvarAutor"> Salvar</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		       </div>
		    </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	
	</div>

<?php if(old()): ?>
	<script type="text/javascript">
		$('#modalMensagem').modal('show');
	</script>
<?php endif; ?>

<script type="text/javascript">
	
	criaFormCoautores();
	buscaCoautor();

	$('#ModalAutores').on('hidden.bs.modal', function(){ 
		console.log("entrou no toogle")
		$('#email').text('');
		$('#email').val('');
		$('#email').attr('placeholder','E-mail');
		$('#email').css("border-color","#ccc");
		$('#nome').text('');
		$('#nome').val('');
	});

	// Função onClick acionada ao clicar no botão para salvar no modal de inclusão de novo autor
	$('#SalvarAutor').on('click', function(){ 
		var id = $('#idAutor').val();
		var nome = $('#nome').val();
		var email = $('#email').val();
		var ordem = $('#OrdemDeAutoria option:selected').val();
		var OrdemHeIgual = false;
		var AutorJaCadastrado = false;
		var IdAutorLogado = $('#AutorLogado').val();

		if(ordem == 0){
			alert('Selecione a ordem de autoria !');
		}

		$('.ordemAutor').each(function(key,val){
			if ( $(this).val() == ordem){

				alert('A ordem de autoria selecionada já foi atribuida a outro autor, verifique a lista de autores do trabalho !');
				OrdemHeIgual = true;
			}
		});

		$('.idAutor').each(function(key,val){
			if ( $(this).val() == id){

				AutorJaCadastrado = true;
			}
		});

		if(OrdemHeIgual == false && ordem != 0){
			// caso o autor já esteja cadastrado só altera as informações
			if(AutorJaCadastrado == true){
				$('#idAutor'+id+'').remove();
				$('#ordemAutor'+id+'').remove();
				// Edita os input com os dados do autor
				var autor = '<input id="idAutor'+id+'" class="idAutor" type="hidden"  name="autores[autor'+id+'][id]" value="'+id+'">'+
							'<input id="ordemAutor'+id+'" class="ordemAutor" type="hidden"  name="autores[autor'+id+'][ordem]" value="'+ordem+'">';

				$('#divAutor'+id+'').append(autor);

				// Edita a tabela que lista os autores
				$('#trAutor'+id+'').html(' ');
				var tr	= 	'<td>'+nome+'</td><td>'+email+'</td><td>'+ordem+'º Autor(a)</td>'+
							'<td><button id="'+id+'" email="'+email+'" nome="'+nome+'" ordem="'+ordem+'" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> ';
				if(IdAutorLogado != id){
					tr +=	'<button id="'+id+'" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button></td>';	
				}		
					
							
				$('#trAutor'+id+'').append(tr);

			}else{
				// insere o input com os dados do autor
				var autor = '<div id="divAutor'+id+'">'+
							'<input id="idAutor'+id+'" class="idAutor" type="hidden"  name="autores[autor'+id+'][id]" value="'+id+'">'+
							'<input id="ordemAutor'+id+'" class="ordemAutor" type="hidden"  name="autores[autor'+id+'][ordem]" value="'+ordem+'">'+	
						'</div>';
				$('#Autores').append(autor);	

				// insere a linha na tabela com os dados do autor
				var tr	= 	'<tr id="trAutor'+id+'">'+
								'<td>'+nome+'</td><td>'+email+'</td><td>'+ordem+'º Autor(a)</td>'+
								'<td><button id="'+id+'" email="'+email+'" nome="'+nome+'" ordem="'+ordem+'" class="btn-sm btn-warning glyphicon glyphicon-pencil editarAutor" type="button"></button> '+
								'<button id="'+id+'" type="button" class="btn-sm btn-danger glyphicon glyphicon-trash excluirAutor"></button></td>'+	
							'</tr>';
				$('#tabelaDeAutores').append(tr);			
			}

			$('#ModalAutores').modal('hide');
						
		}
	});

	// Editar Autor 
	$(document).on('click','.editarAutor',function(){ 
		var id = $(this).attr('id');
		var email = $(this).attr('email');
		var nome = $(this).attr('nome');
		
		$('#idAutor').val(id);
		$('#email').val(email);
		$('#nome').val(nome);

		$('#ModalAutores').modal('show');

	});

	// Excluir autor
	$(document).on('click','.excluirAutor',function(){ 
		console.log('entrou na função excluir');
		var id = $(this).attr('id');
		$('#trAutor'+id+'').remove();
		$('#idAutor'+id+'').remove();
		$('#ordemAutor'+id+'').remove();
	
	});	

</script>

<?php $__env->stopSection(); ?>
<style type="text/css" media="screen">
	input{
		text-align: center;
	}
</style>


<?php echo $__env->make(session('acesso_id') === 1 ? '/usuarios/autores/header' : '/usuarios/avaliadores/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>