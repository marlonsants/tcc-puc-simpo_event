<?php 
use App\Model\Eventos_acesso_id;
use App\Model\Evento;
use App\Model\Avaliadores;
$acesso = Eventos_acesso_id::getAcessoNoEvento(session('id'),session('evento_id') );
$data = Evento::datasConf();
$nome_evento = Evento::ver_nome_evento();
if($acesso[0]['acesso_id'] == 2){
  $avaliador = Avaliadores::where('pessoa_id',session('id'))->where('evento_id',session('evento_id'))->get();
}
?>


<!DOCTYPE html>
<html lang="pt"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>System4college - Autor</title>

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/app.js"></script>


  <script type="text/javascript" src="/js/jquery-ui.js"></script>
  @stack('mask')
  @stack('js')
</head>

<body>
  <header>
    <div class="container-fluid">

      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          @if(!empty($nome_evento[0]) )
          <a href="/autor/trabalhos/listar" class="navbar-brand">{{ $nome_evento[0]->nome_evento }}</a>
          @else
          <a href="/autor/trabalhos/listar" class="navbar-brand">System4college</a>
          @endif
          <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
        </div>
        @if(session()->has('evento_id') )
        <div class="collapse navbar-collapse" id="menu">
          <ul class="nav navbar-nav">
            @if($acesso[0]['acesso_id'] == 2)
              @if($data['dataAtual'] >= $data['data_ini_ava'] and $avaliador[0]->status == 1 )
              <li><a href="/avaliador/trabalhos">Avaliações</a></li>
              @endif
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trabalhos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="/autor/trabalhos/novo">Criar Novo</a></li>
                <li><a href="/autor/trabalhos/listar">Meus trabalhos</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ajuda <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="/autor/trabalhos/manual_submissao">Manual de Submissão</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Termos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="disabled"><a href="#">Foi lido e acordado:</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/autor/trabalhos/direitos_autorais">Direitos Autorais</a></li>
                <li><a href="/autor/trabalhos/regras">Regras</a></li>
                <li role="separator" class="divider"></li>
              </ul>


            </ul>
            @endif
            <div class="navbar-right margin_right">   
              <ul class="nav navbar-nav ">
                <p class="navbar-text text-center ">Logado como:</p>
                <li class="dropdown"> 
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(session()->has('pessoa_nome'))
                    {{session()->get('pessoa_nome')}}  
                    @else 
                    Login expirou!
                    @endif
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="/autor/editarperfil/{{session()->get('id')}}" class="text-center">Perfil</a></li>
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
              @if(session()->has('mensagem'))
              <div class="row" id="msg_suc">
                <div class='alert alert-success text-center'>{{session('mensagem')}}</div>
              </div>
              @endif
              @yield('conteudo')
            </div>
          </div>
        </main>
      </body>
      </html>
