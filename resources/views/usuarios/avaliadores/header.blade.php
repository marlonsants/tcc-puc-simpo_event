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

  <title>System4college - Avaliador</title>

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/app.js"></script>

  <script type="text/javascript" src="/js/jquery-ui.js"></script>
  @stack('mask')

</head> 
<body>
  <header>
    <div class="container-fluid">

    </div>  
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
         @if(!empty($nome_evento[0]) )
          <a href="/autor/home" class="navbar-brand">{{ $nome_evento[0]->nome_evento }}</a>
          @else
          <a href="/autor/home" class="navbar-brand">System4college</a>
          @endif
          <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
      </div>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav">
          <li><a href="/avaliador/trabalhos">Avaliações</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Instruções <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="disabled text-center"><a href="#">Auxilio para avaliações</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/avaliador/instrucoes">Regras de Avaliação</a></li>
              <li><a href="/avaliador/regras/download">Baixar Arquivo Oficial <span class="glyphicon glyphicon-download-alt alinhar-esquerda text-info"> </span></a> </li>
            </ul>
          </li> 

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trabalhos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="disabled"><a href="#">Artigos</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/autor/trabalhos/novo">Criar Novo</a></li>
              <li><a href="/autor/trabalhos/listar">Meus Trabalhos</a></li>
              <li class="disabled"><a href="#">Foi lido e acordado:</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/avaliador/trabalhos/direitos_autorais">Direitos Autorais</a></li>
              <li><a href="/avaliador/regras/autores">Regras</a></li>
              <li><a href="/autor/trabalhos/manual_submissao">Manual de Submissão</a></li>
              <li role="separator" class="divider"></li>
            </ul>
          </li>


        </ul>
        <div class="navbar-right margin_right">   
          <ul class="nav navbar-nav ">
            <p class="navbar-text text-center ">Logado como:</p>
            <li class="dropdown"> 
              <a href="#" class="dropdown-toggle text-center" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if(session()->has('pessoa_nome'))
                {{session()->get('pessoa_nome')}}  
                @else 
                Login expirou!
                @endif
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li role="separator" class="divider"></li>
                 <li><a href="/pessoa/editarperfil" class="centralizar"> Editar Perfil</a></li>
                  <li><a href="/definir_acesso" class="text-center" data-toggle="tooltip" data-placement="botom" title="clique para alterar o tipo de acesso">Tipo de acesso</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="centralizar"><a href="/logout"><b>Sair</b></a></li>
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
