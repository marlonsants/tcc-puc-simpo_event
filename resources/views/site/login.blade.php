@extends('/site/header')
@section('conteudo')

<body class="body-cinza">
	<div class="row ">	
		@if(isset($msg_erro))
		<div class='alert alert-danger text-center msg_error'>{{$msg_erro}}</div>
		@endif
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-6 col-md-offset-3 box-login">
			<div class="panel panel-default panel-body borda-0px sombra">
				{{-- <div class="alert alert-info">Esse cadastro é de uso exclusivo do site SGAgro, sendo necessário a criação de um novo, para a inscrição no site da Funep</div> --}}

				<form action="{{url('/login/verificar')}}" method="POST" accept-charset="utf-8">
					{!!csrf_field()!!}
					<center class="legenda">Login</center>

					<?php
					$mensagem = '';
					if( isset($msg) && !is_null($msg) ){

						if($msg == '1'){
							$mensagem = '<strong>Sua senha foi atualizada com sucesso!</strong>';
						}elseif($msg == '0'){
							 $mensagem = '<strong><p>Não foi possivel realizar a alteração da senha</p></strong><p> verifique os dados informados e tente novamente!</p>';
						}elseif($msg == '3'){
							$mensagem = '<strong>Sua senha foi atualizada com sucesso!</strong>';
						}elseif($msg == '4'){
							 $mensagem = '<strong><p>Não foi possivel realizar a alteração da senha</p></strong><p> verifique os dados informados e tente novamente!</p>';
						}elseif($msg == '5'){
							 $mensagem = '<strong><p>Cadastro efetuado com sucesso !</p>';
						}

						$status = ($msg == '1' || $msg == '3' || $msg == '4' || $msg == '5'  ) ? 'success' : 'warning';

						if ($mensagem != null) {
							echo '<div class="alert alert-'.$status.'">';
							echo '<div><center>'.$mensagem.'</center></div>';
							echo '</div>';
						}
					}

					?>

					
					<div class="col-md-12">
						<div class="row">	
							<input type="email" name="email" class="form-control text-center borda-0px" placeholder="E-mail">
						</div>
						<div class="row">
							<input type="password" name="senha" class="form-control text-center borda-0px" placeholder="Senha">	
						</div>
						<div class="row">
							<input type="submit" name="btnlogar" class=" form-control btn btn-primary borda-0px" value="Acessar">
						</div>
						<div class="row"> 
						<a href="/social/login" target="_self" name="btnlogarComGoogle" class=" form-control btn btn-link borda-0px">Login com Google</a>
						</div>
						<div style="font-weight: bold" class="row text-center">
							<a href="/nova_senha" class="col-md-12 col-xs-12">Esqueceu a senha?</a>
							<a href="/cadastrar" class="col-md-12 col-xs-12">Criar uma nova conta</a>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>

	@stop