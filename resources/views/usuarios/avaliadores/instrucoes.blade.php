@extends("/usuarios/avaliadores/header")

@section('conteudo')

<div class="row">
<div class="col-md-8 col-md-offset-2">
	<h3 class="text-center">Instruções para Avaliações</h3>
	<p class="text-center alert-info"><b>A nota final é formada pela média ponderada baseada em {{$criterioCount}} critérios, os quais podem ser avaliados com notas de <span class="text-danger">0</span> a <span class="text-danger">{{$evento->max_nota_trabalhos}}</span> pontos.<br>Para realizar uma avaliação basta clicar na aba 'Avaliações' que se encontra no menu do sistema.<br>O periodo de Avaliação sera de <span class="text-danger">{{$data['data_ini_ava_br']}}</span> a <span class="text-danger">{{$data['data_fim_ava_br']}}</span></b></p>
	<hr>

	<h4><b>Listagem de Trabalhos</b></h4>
	<p>Ao clicar sobre a aba Avaliações, você será redirecionado para a tela de listagem de trabalhos, nesta tela você verá a uma tabela contendo as informações dos trabalhos que estarão disponíveis para você avaliar.</p>

	<label>Os campos desta tabela são:</label>
	<p>
		<ul>
			<li><b>Título:</b> Apresenta o título do trabalho a ser avaliado.</li>
			<li><b>Área:</b> Apresenta qual a área em que o trabalho foi enquadrada pelo autor.</li>
			<li><b>Categoria:</b> Apresenta qual a categoria em que o trabalho foi enquadrada pelo autor.</li>
			<li><b>Status:</b> Apresenta se o artigo foi aprovado, reprovado ou se ainda necessita ser avaliado.</li>
			<li>
				Ações: Apresenta botões que lhe auxiliarão na avaliação do trabalho sendo eles:
				<ul>
					<li><b>Avaliar trabalho</b> <button class="btn btn-primary"><span class="glyphicon glyphicon-search" /></button>:</b> Ao clicar sobre ele você será direcionado para uma nova tela onde será realizada a avaliação do trabalho selecionado ao clicar no botão.</li><br>
					<li><b>Visualizar Trabalho</b> <button class="btn btn-success"><span class="glyphicon glyphicon-eye-open" /></button>:</b> Permite abrir uma nova aba em seu navegador contendo o trabalho avaliado em formato PDF.</li><br>
					<!-- <li><b>Requisitar Correção</b> <button class="btn btn-warning"><span class="glyphicon glyphicon-pencil" /></button>:</b> Permite mandar uma mensagem ao autor do trabalho pedir para que o autor realize correções no trabalho como, por exemplo, correções de erros gramaticais.</li> -->
					<br>
				</ul>
			</li>
		</ul>
	</p><hr>

	<h4><b>Tela de Avaliação:</b></h4>
	<p>Ao clicar no botão Avaliar trabalho(botão azul com uma lupa), na tela de Listagem de trabalhos, você será direcionado para esta tela.</p>

	<p>
		Nela você encontra cada um dos critérios de avaliação acompanhadas do peso de cada uma delas, e também encontrará os seguintes elementos:
		<ul>
			<li><b>Campo Nota:</b> Nele você ira dar a nota do trabalho referente ao critério.</li>
			<li><b>Botão detalhes</b> <button class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" /></button><b>:</b> Permite que você visualize dentro de pop-up uma descrição detalhada do critério.</li>
			<li><b>Botão confirmar Avaliação</b> <button class="btn btn-success"><span class="glyphicon glyphicon-ok" /> Confirmar Avaliação</button><b>:</b> Este botão confirmara que foram das as notas de cada critério e que a avaliação daquele trabalho foi concluída, ao clicar neste botão aparecerá uma pop-up perguntando se você aplicou cada uma das notas corretamente e se você deseja finalizar a avaliação.<br><br><label>Importante:</label> Ao clicar em ‘sim’ no pop-up, a avaliação do trabalho será encerrada e não poderá mais ser alterado, por isso recomendamos que se tenha muita atenção na avaliação e que se preste atenção em cada um dos critérios.</li>
		</ul>
	<p><hr>

	<h4><b>Critérios:</b></h4>
	<p>Veja quais são os criterios de avaliação suas descriçoes e o peso:</p>
	<table class="table table-bordered table-responsive table-bordered table-condensed table-striped">
		<thead style="background-color: white">
			<tr style="color:black;">
				<td><b>Nome do Criterio</b></td>
				<td><b>Descrição</b></td>
				<td><b>Peso</b></td>
			</tr>
		</thead>

		@forelse($criterios as $criterio)
		<tr>
			<td>{{$criterio->nome}}</td>
			<td>{{$criterio->descricao}}</td>
			<td>{{$criterio->peso}}</td>
		</tr>
		@empty
		<tr><td colspan="3"><b>Não há criterios cadastrados ainda.</b></td></tr>
		@endforelse
	</table><hr>

</div>
</div>

@stop
 