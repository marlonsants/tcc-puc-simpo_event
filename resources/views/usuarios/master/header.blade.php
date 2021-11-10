<?php
use App\Model\Evento;
$nome_evento = Evento::ver_nome_evento();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>4Events - Master</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="/js/jquery-ui.js"></script>

</head>
<body>
    <header>
        <div class="container-fluid">
           
        </div>  
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                @forelse($nome_evento as $nome)
                <a href="/master/home" class="navbar-brand">{{ $nome->nome_evento }}</a>
                @empty
                <a href="/master/home" class="navbar-brand">System4college</a>
                @endforelse
                <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
            </div>
            <div class="collapse navbar-collapse" id="menu">
              <ul class="nav navbar-nav">
                <li><a href="#">Artigos</a></li>
                <li><a href="#">Regras</a></li>


                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#" class="pintar-vermelho">Deslogar</a></li>
                </ul>
            </li> 


        </ul>
        <div class="navbar-right margin_right">   
            <ul class="nav navbar-nav ">
                <p class="navbar-text text-center ">Logado como:</p>
                <li class="dropdown"> 
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      @if(session()->has('pessoa_nome'))
                      <small>{{session()->get('pessoa_nome')}}</small>
                      @else 
                      erro
                      @endif<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Configurar Perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <a href="#" ><li class="text-center pintar-vermelho"><b>Logout</b></li></a>
                    </ul>
                </li>
            </ul> 
        </div>

    </div>
</nav>
</header>

<main>
  <div class="col-xs-12 col-sm-12 col-md-12">  
      <div class="container-fluid">
          @yield('conteudo') 
      </div>
  </div>
</main>
</body>
</html>