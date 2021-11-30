

<!DOCTYPE html> 
<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SimpoEvent</title>
	<link rel="shortcut icon" type="imagex/png"  href="/public/images/icon.ico">
	<!-- Fonts -->
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
	<script type="text/javascript" src="/js/mask/jquery.mask.js"></script>
	<script type="text/javascript" src="/js/pessoas.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
	<script type="text/javascript" src="/js/datatables.min.js"></script>
	<script src="/js/chart/Chart.js"></script>


	<!-- Styles -->
	<style>
		.navbar-header button{ color:#fff; }
	</style>

</head>
<body>
	@if(!isset($pessoa))
	<header>
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">SimpoEvent</a>
				<button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
			</div>
			<div class="collapse navbar-collapse" id="menu">
				<ul class="nav navbar-nav">
				
				</ul>
				<div class="navbar-right margin_right">   
					<ul class="nav navbar-nav ">
						<li class="dropdown"> 
							<a href="/login" class="navbar-brand">Login</a>
						</li>
					</ul> 
				</div>
			</div>
		</nav>
	</header>
	@else

	<header>
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">4Events</a>
				<button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
			</div>

			<div class="navbar-right margin_right">   
				<ul class="nav navbar-nav ">
					<li>
						<a href="javascript:window.history.go(-1)" value="Voltar"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
					</li>
					<p class="navbar-text text-center ">Logado como:</p>
					<li class="dropdown" style="margin-right: 10px"> 
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							@if(session()->has('pessoa_nome'))
							{{session()->get('pessoa_nome')}}  
							@else 
							Login expirou!
							@endif
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/autor/editarperfil/{{session()->get('id')}}" class="text-center">Editar Perfil</a></li>
								<li role="separator" class="divider"></li>
								<li class="centralizar"><a href="/logout"><b>Sair</b></a></li>
							</ul>
						</li>
					</ul> 
				</div>
			</div>
		</nav>
	</header>
	@endif
	<main>
		<div class="container">
			@yield("conteudo")
		</div>
	</main>
</body>
</html>
