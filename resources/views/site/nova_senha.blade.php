@extends('/site/header')

@section('conteudo')

<body class="body-cinza">

	<div class="row">
		<div class="col-xs-12 col-md-6 col-md-offset-3 box-login">
			<div class="panel panel-default panel-body borda-0px sombra">
				<form action="/alterasenha" method="POST" accept-charset="utf-8" class="form-group" id="alterasenha">
					{!!csrf_field()!!}
					<h3 class="text-center">Nova senha</h3>

					<div id="msg">
						
					</div>

					<div class="row">
						<div class="col-md-12">
						{{csrf_field()}}
							<input  required type="email" name="usuario" class="form-control margin-top-10" placeholder="E-mail">
							<input  required type="password" name="senha" class="form-control margin-top-10" placeholder="Nova senha">
							<input  required type="password" name="confirSenha" class="form-control margin-top-10" placeholder="Confirme a senha">
							<!--<input  required type="text" name="CPF" class="form-control margin-top-10" placeholder="Informe seu CPF">
							<input  required type="text" name="rg" class="form-control margin-top-10" placeholder="Informe seu RG">-->
							<select name="pergunta" id="pergunta" class="form-control margin-top-10" disabled >
								<option value="" selected >Busque sua pergunta inserindo seu email:</option>
								@foreach($perguntas as $pergunta)
								<option value="{{$pergunta->id}}"	>{{$pergunta->pergunta}}</option>}
								@endforeach		
							</select>
							<input  required type="text" name="resposta" class="form-control margin-top-10" placeholder="Digite a resposta da sua pergunta de segurança">
						</div>
					</div><br>
					<div class="row">
						<div class="col-xs-12 col-md-5">
							<a href="javascript:window.history.go(-1)" class="btn btn-warning margin-top-10 form-control" value="Voltar">Voltar</a>
						</div>
						<div class="col-xs-12 col-md-offset-2 col-md-5">
							<input type="button" name="btnlogar" id="btnlogar" class="btn btn-primary margin-top-10 form-control" value="Enviar" onclick="enviaFormulario()" >
							<input type="submit" name="" id="envia" style="display: none">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function setAlert(mensagem){
			var msg = '';
			msg += '<div class="alert alert-info alert-dismissable">';
			msg += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			msg += mensagem;
			msg += '</div>';

			return msg;
		}

		function validarSenha(){
			if( $("input[name='senha']").val() < 6){
				var msg = setAlert('<p>A senha deve conter no minimo 6 caracteres!</p>');
				return msg;
			}else{
				return '';
			}
		}


		function validarConfirmarSenha(){
			if( $("input[name='confirSenha']").val() !== $("input[name='senha']").val() ){
				var msg = setAlert('<p>As senhas não conferem!</p>');
				return msg;
			}else{
				return '';
			}
		}

		function validarFormulario(){
			var mensagens = '';

			mensagens += validarSenha();
			mensagens += validarConfirmarSenha();

			$("#msg").html(mensagens);

			return mensagens;
		}



		$("input[name='usuario']").change(function(){
			getPerguntaEmail();
		});

		function getPerguntaEmail(){
			data = {};
			data.email = $("input[name='usuario']").val();
			data._token = $("input[name='_token']").val();
			$.ajax({
				type: "POST",
				url: '/getPerguntaEmail',
				data: data,
				dataType: 'json',
				success: function(o){
					console.log(o);
					console.log(o[0].pergunta_id);

						$("#pergunta").val(o[0].pergunta_id);
						$("#pergunta").prop('disabled', true);
					},
				error: function(){
					var msg = setAlert('<p>Email não localizado!</p>');
					$("#msg").html(msg);				}
			});
		}

 function enviaFormulario(){
 	var valida = validarFormulario();

 	if(valida == ''){
 		$('#envia').click();
 	}
 }
	</script>
	@stop