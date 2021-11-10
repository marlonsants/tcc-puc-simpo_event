<!DOCTYPE html>
<html>
<head>
	<title>Anais 2018</title>
</head>

<style type="text/css">
	/*-----------------------------------------------------------------*/
	/* CSS da pagina de teste, não precisa jogar no site */
	body {margin: 0; background-color: #999; }
	main{width: 94%; background-color: white; margin: 3%;}
	header, footer {background-color: green; width: 100%; height: 120px;}
	/* Fim do CSS de teste */
	/*-----------------------------------------------------------------*/


	/* configurações  para telas com width maior que 1200 */
	iframe{width: 98%; margin: 1%; height: 2100px; border: hidden;}

	/* heights diferentes para tamanhos de telas diferentes do iframe*/
	@media only screen and (max-width: 1200px) {
		iframe{height: 2350px;}
	}
	@media only screen and (max-width: 1000px) {
		iframe{height: 2600px;}
	}
	@media only screen and (max-width: 800px) {
		iframe{height: 2700px;}
	}
	@media only screen and (max-width: 700px) {
		iframe{height: 2900px;}
	}
	@media only screen and (max-width: 600px) {
		iframe{height: 3250px;}
	}
	@media only screen and (max-width: 500px) {
		iframe{height: 3450px;}
	}

	@media only screen and (max-width: 450px) {
		iframe{height: 3700px;}
	}
	@media only screen and (max-width: 400px) {
		iframe{height: 4200px;}
	}
	/* fim heights diferentes */
</style>

<body>

<main>
	<header>
		<center><h1>Cabeçalho do Evento</h1></center>
	</header>
	<!-- iframe que deve ser inserido na pagina -->
	<iframe src="http://localhost:8000/anais/1" scrolling="yes">
		
	</iframe>

	<footer>
		<center><h1>Rodapé do Evento</h1></center>	
	</footer>
</main>

</body>
</html>