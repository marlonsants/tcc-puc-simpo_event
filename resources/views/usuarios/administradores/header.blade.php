<?php
use App\Model\Adm_permissoes;
use App\Model\Evento;

define('NIVEL_ACESSO_MASTER', 4);

define('PERMISSAO_ACESSO_AUTOR', 1);
define('PERMISSAO_ACESSO_TRABALHOS', 2);
define('PERMISSAO_ACESSO_AVALIADOR', 3);
define('PERMISSAO_ACESSO_CADASTROS', 4);
define('PERMISSAO_ACESSO_PAINEL_ANALITICO', 5);
define('PERMISSAO_ACESSO_PRE_AVALIACAO', 6);
if(session('acesso_id') != 4){
  $permissoes = Adm_permissoes::buscaPermissoes(session('id'));  
}else{
  $permissoes = [];
}

$Eventos = Evento::verDatasSubmissao();
$nome_evento = Evento::ver_nome_evento();

?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 

  <title>System4college - Administrador</title>

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
  <link href="/css/hover.css" rel="stylesheet" media="all">
  <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/datatables.min.js"></script>
  <script type="text/javascript" src="/js/app.js"></script>
  <script src="/js/chart/Chart.js"></script>

  <script type="text/javascript" src="/js/jquery-ui.js"></script>
  @stack('scripts')

</head>
<body>
  <header>
    <div class="container-fluid">

    </div>  
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        @forelse($nome_evento as $nome)
        <a href="/administrador/analise/completa" class="navbar-brand">{{ $nome->nome_evento }}</a>
        @empty
        <a href="/administrador/analise/completa" class="navbar-brand">System4college</a>
        @endforelse
        <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
      </div>
      <!-- Antes de Abri o Menu Verificar se o evento já foi selecionado -->

      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav">
          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER || in_array(PERMISSAO_ACESSO_AUTOR,$permissoes))
            <li><a href="/administrador/autores/listar">Autores</a></li>
          @endif

          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER || in_array(PERMISSAO_ACESSO_AVALIADOR,$permissoes))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliadores <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/avaliadores/listar">Avaliadores</a></li>
              <li><a href="/administrador/avaliadores/atribuir">Atribuir Avaliadores</a></li>
              <li><a href="/administrador/avaliadores/progresso">Progresso de avaliações</a></li>
              <li role="separator" class="divider"></li>
            </ul>
          </li>
          @endif

          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER || in_array(PERMISSAO_ACESSO_TRABALHOS,$permissoes))
            <li>
              <a href="/administrador/trabalhos/listar">Trabalhos</a>      
            </li> 
          @endif

          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER || in_array(PERMISSAO_ACESSO_CADASTROS,$permissoes))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/cadastrar">Administrador</a></li>
              <li><a href="/administrador/eventos">Eventos</a></li>
              <li><a href="/administrador/cadastros_basicos/categorias">Categorias</a></li>
              <li><a href="/administrador/cadastros_basicos/areas">Áreas</a></li>
              <li><a href="/administrador/cadastros_basicos/criterios">Critérios de Avaliações</a></li>
              <li role="separator" class="divider"></li>
            </ul> 
          </li>
          @endif
          
          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER || in_array(PERMISSAO_ACESSO_PRE_AVALIACAO,$permissoes)) 
          <li><a href="/administrador/pre_avaliar" title="Avaliação auxiliar">Pré avaliação</a></li>
          @endif
          <li><a href="/administrador/analise/completa">Painel Analítico</a></li>

          @if(session()->get('acesso_id') == NIVEL_ACESSO_MASTER) 
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
             <ul class="dropdown-menu">
              <li><a href="/administrador/editar/permissao">Editar permissões dos administradores</a></li>
            </ul>
          </li>
          @endif
        </ul>
        <div class="navbar-right margin_right" style="margin-right: 5px">   
          <ul class="nav navbar-nav ">
            <li class="dropdown"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                <!-- Exibe o nome do usuario logado -->
                @if(session()->has('pessoa_nome'))
                <small> {{session()->get('pessoa_nome')}}  </small>
                @else 
                Login expirou!
                @endif
                
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 <li><a href="/administrador/editarperfil" class="centralizar"> Editar Perfil</a></li>
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
        <!-- exibir o conteudo da pagina    -->
        <div class="row">
          <nav >
            <?php
            $array = array(
              '/administrador/cadastros_basicos/categorias',
              '/administrador/cadastros_basicos/areas',
              '/administrador/cadastros_basicos/criterios'
              );
              ?>
              @if(session()->has('evento_id') and in_array($_SERVER ['REQUEST_URI'], $array))
              <ul class="nav nav-tabs nav-justified" id="menu">
                @if($Eventos[0]->fim_submissao >= date('Y-m-d'))
                <li role="presentation" id="categoria"><a href="/administrador/cadastros_basicos/categorias" class=" hvr-wobble-horizontal">Cadastrar categorias</a></li>
                <li role="presentation" id="area"><a href="/administrador/cadastros_basicos/areas" class=" hvr-wobble-horizontal">Cadastrar áreas</a></li>
                <li role="presentation" id="criterios"><a href="/administrador/cadastros_basicos/criterios" class=" hvr-wobble-horizontal">Cadastrar critérios de avaliação</a></li>
                @endif
              </ul>
              @elseif(in_array($_SERVER ['REQUEST_URI'], $array))
              <ul class="nav nav-tabs nav-justified" id="menu">
                <li role="presentation" id="novoevento"><a href="/administrador/eventos/novo" class=" hvr-wobble-horizontal">Criar novo evento</a></li>
              </ul>
              @endif
            </nav>
          </div>
          <div class="row">

            @yield('conteudo')
          </div>
        </div>
      </div>
    </main>
  </body>
  </html>

