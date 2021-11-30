@extends('/usuarios/administradores/header')

@section("conteudo")
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
				<h3>{{ $qtdAutores or 0 }}</h3>
			</div>		
		</div>

		<!-- Total de Avaliadores -->
		<div class="col-xs-12 col-md-3 ">
			<div class=" col-xs-2 col-md-2 caixa-grafico fundo-amarelo sombra">
			<h4><span class="glyphicon glyphicon-user letra-amarelo col-xs-offset-1 col-md-offset-3 caixa-icone"> </span></h4> 
			</div>		
			<div class="col-xs-10 col-md-10 caixa-grafico text-center letra-amarelo">
				<h4>Total de Avaliadores aprovados</h4>
				<hr>
				<h3>{{ $qtdAvaliadores or 0 }}</h3>
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
				<h3>{{ $qtdTrabalhos or 0 }}</h3>
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
				<h3>{{ $qtdTotal or 0 }}</h3>
			</div>	
		</div>
	</div>
</div>

{!! Charts::assets() !!}

<div class="row" style="margin-top: 60px">
    <div class="col-md-8 col-md-offset-2">
        {!! $chart->render() !!}     
    </div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-2 col-xs-6">
		<b>Trabalhos Avaliados: {{ $qtd or 0 }}</b>
	</div>
	<div class="col-md-4 col-xs-6" style="text-align: right;">
		<b>Trabalhos Submetidos: {{ $qtdTotal or 0 }}</b>
	</div>
</div>

<center class="row" style="margin-top: 80px">
	<div class="col-md-3">
		{!! $chart2->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart3->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart4->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart5->render() !!} 
	</div>
</center><hr>

<center class="row">
	<div class="col-md-3">
		{!! $chart6->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart7->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart8->render() !!} 
	</div>
	<div class="col-md-3">
		{!! $chart9->render() !!} 
	</div>
</center><hr>

<div class="row" style="margin-top: 80px">
	<div class="col-md-6">
		{!! $chart10->render() !!} 
	</div>
	<div class="col-md-6">
		{!! $chart11->render() !!} 
	</div>
</div><hr>
@stop 