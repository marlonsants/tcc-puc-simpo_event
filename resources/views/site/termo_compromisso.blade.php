@extends('/site/header')

@section('conteudo')
<body class="body-cinza">

	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-default panel-body borda-0px sombra">

				<h3 class="centralizar text-info">TERMOS DE RESPONSABILIDADE</h3>
				
				<?php 
				$array = explode('/',$_SERVER['HTTP_REFERER']);
				$origem = end($array);
				if($origem == 'termo_compromisso'){
					echo "<div class='alert alert-info'><p>Antes de prosseguir é necessario concordar com os termos propostos!</p></div>";
				}
				?>


				
				<ol>
					<li>Sendo o trabalho aprovado, o evento se reserva o direito de efetuar, nos arquivos originais aprovados, alterações de ordem normativa, ortográfica e gramatical, com o intuito de manter o padrão culto da língua, respeitando, porém, o estilo dos autores.</li>
					<li>A submissão do trabalho autoriza, automaticamente, sua publicação, com exclusividade, nos anais do evento, bem como autoriza a incorporação do trabalho no acervo eletrônico do Simpósio em Gestão do Agronegócio, sem ônus alusivos aos direitos autorais, com base no disposto na Lei Federal nº 9.610, de 19 de fevereiro de 1998. Assegura-se ao Simpósio em Gestão do Agronegócio o direito à divulgação da informação e os direitos autorais, na forma da Lei.</li>
					<li>Cabe ressaltar que os trabalhos publicados no Simpósio em Gestão do Agronegócio são de acesso público e gratuito aos interessados, sendo proibido qualquer tipo de aplicação comercial.</li>
					<li>Os autores são totalmente responsáveis pelo conteúdo dos trabalhos publicados.</li>
				</ol>

				<form action="/aceitar_termo" method="post" accept-charset="utf-8">
					{{csrf_field()}}
					<input type="hidden" name="evento_id" value="{{$evento->id}}">
					<input type="hidden" name="pessoa_id" value="{{$pessoa->id}}"><br>
					<center class="row">
						<input type="checkbox" name="aceito" id="aceito"><label class="text text-info" for="aceito"> Li e concordo com o termo acima.</label></input>
					</center>
					<br/>
					<div class="row">
						<div class="col-md-4 col-md-offset-2">
							<button class="form-control btn btn-warning">Voltar</button>				
						</div>
						<div class="col-md-4">
							<input type="submit" class="btn btn-success form-control">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	@stop