@extends('usuarios/header')


@section('conteudo')

<body class="body-cinza">
<div class="row">
	@if(Session::has('msg'))
		<div class="alert alert-danger text-center"><p><b>{{Session::get('msg')}}</b></p></div>
	@endif

	@if(Session::has('suc'))
		<div class="alert alert-danger text-center"><p><b>{{Session::get('suc')}}</b></p></div>
	@endif
	<div class="col-md-12">
		<div class="panel panel-default panel-body borda-0px sombra">

			@if($arrayDatas['dataAtual'] >= $arrayDatas['data_ini_sub'])
				@if($possuiAcesso == true)
					<div class="alert alert-info text-center">
						<h4>Para alterar o seu tipo de acesso selecione uma das opções e clique em continuar</h4>
					</div>

				@else
					<div class="alert alert-info">
						<h3>Olá {{$nome_pessoa[0]['nome']}}, você selecionou o evento {{$evento->nome_evento}}<br>
						Tema do Evento: {{$evento->tema}}, como esta é a primeira vez que esta acessando este evento, antes de continuar você precisa definir seu tipo de usuário</h3>

						<h3>Os tipos são:</h3>
						<h4>Autor: Tem permissão somente pra submeter trabalhos e acompanhar o status de avaliação e resultados dos mesmos, para saber mais leia o manual de submissão no menu após acessar o sistema.</h4>
						<h4>Avaliador: Ao definir o tipo de usuário como avaliador você estará se candidatando a participar da banca de avaliação de trabalhos deste evento, contudo os privilégios de avalaidor só serão liberados quando a comissão organizadora do evento aprovar sua candidatura, para que seja aprovada a comissão ira certificar se seus dados são integros e se o seu perfil profissional é adequando pra assumir esse cargo, se sua candidatura não for aprovada seu nivel de acesso será  automatiamente convertido para autor</h4>
					</div>
				@endif

				<div class="col-md-8 col-md-offset-2">	
					<div class="text-center">
						@if($possuiAcesso == true)
							<form class="form" action="autor/acesso/update" method="post">
						@else
							<form class="form" action="/sistema" method="post">
						@endif	
							{!!csrf_field()!!}
							<div class="col-md-offset-2 col-md-8">
								<select id="acesso_id" name="acesso_id" class="form-control">
									@forelse($acessos as $acesso)
										@if($acesso->id != 3 and $acesso->id != 4)
										<option value="{{$acesso->id}}">{{$acesso->descricao}}</option>
										@endif
									@empty
									<h5>Niveis de acesso não cadastrado</h5>
									@endforelse
								</select>
								<label id="label" style="display:none">Selecione a área temática que deseja se canditar pra avaliar</label>
								<select id="area" name="area" class="form-control" style="display:none">
									@forelse($areas as $area)
									<option value="{{$area->id}}">{{$area->nome}}</option>
									@empty
									<h5>Areas não cadastradas</h5>
									@endforelse
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
			@else
				<div class="text-center">
					
					<div class="alert alert-info">
						<h3>Olá {{$nome_pessoa[0]['nome']}} as submissões de trabalhos para este evento ainda não iniciaram, de acordo com o cronograma do evento irá inciar na seguinte data {{$arrayDatas['data_ini_sub_br']}}</h3>
						<h3>O acesso ao sistema só será concedido a partir da data informada, aproveite este tempo pra revisar e melhorar o seu trabalho</h3>
						<h3>Agradecemos a compreensão !</h3>
						<a class="btn btn-primary" href="/eventos"> Escolher outro evento</a>
					</div>
					
				</div>
			@endif
		</div>
	</div>
</div>
@stop



