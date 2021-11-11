<?php
use App\Model\Adm_permissoes;
use App\Model\Evento;
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
  <?php echo $__env->yieldPushContent('scripts'); ?>

</head>
<body>
  <header>
    <div class="container-fluid">

    </div>  
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <?php $__empty_1 = true; $__currentLoopData = $nome_evento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nome): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
        <a href="/administrador/home" class="navbar-brand"><?php echo e($nome->nome_evento); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
        <a href="/administrador/home" class="navbar-brand">System4college</a>
        <?php endif; ?>
        <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">Menu</button>
      </div>
      <!-- Antes de Abri o Menu Verificar se o evento já foi selecionado -->

      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav">
          <?php if(session()->get('acesso_id') == 4 || in_array(1,$permissoes)): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Autores <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="disabled"><a href="#">Usuários</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/autores/listar">Listar autores</a></li>
              <li role="separator" class="divider"></li>

            </ul>
          </li>
          <?php endif; ?>
          <?php if(session()->get('acesso_id') == 4 || in_array(2,$permissoes)): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trabalhos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li>
                <a href="/administrador/trabalhos/listar">Listar trabalhos</a>      
              </li> 

            </ul>
          </li>
          <?php endif; ?>

          <?php if(session()->get('acesso_id') == 4 || in_array(3,$permissoes)): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliadores <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="disabled"><a href="#">Usuários</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/avaliadores/listar">Listar Avaliadores</a></li>
              <li role="separator" class="divider"></li>
              <li class="disabled"><a href="#">Trabalhos</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/avaliadores/atribuir">Atribuir Avaliadores</a></li>
              <li><a href="/administrador/avaliadores/progresso">Progresso de avaliações</a></li>
              <li role="separator" class="divider"></li>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(session()->get('acesso_id') == 4 || in_array(4,$permissoes)): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/cadastrar">Novo Administrador</a></li>
              <?php if($Eventos[0]->fim_submissao >= date('Y-m-d')): ?>
              <li role="separator" class="divider"></li>
              <li class="disabled"><a href="#">Cadastros Básicos</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/cadastros_basicos/categorias">Categorias</a></li>
              <li><a href="/administrador/cadastros_basicos/areas">Áreas</a></li>
              <li><a href="/administrador/cadastros_basicos/criterios">Critérios de Avaliações</a></li>
              <li role="separator" class="divider"></li>
              <?php endif; ?>
            </ul> 
          </li>
          <?php endif; ?>

          <?php if(session()->get('acesso_id') == 4 || in_array(5,$permissoes)): ?> 
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dashboard <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="disabled"><a href="#">Graficos</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/administrador/analise/completa">Grafico Analítico</a></li>
              <li role="separator" class="divider"></li>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(session()->get('acesso_id') == 4 || in_array(6,$permissoes)): ?> 
          <li><a href="/administrador/pre_avaliar" title="Avaliação auxiliar">Avaliação auxiliar</a></li>
          <?php endif; ?>

          <?php if(session()->get('acesso_id') == 4): ?> 
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
             <ul class="dropdown-menu">
               <li><a href="/administrador/eventos/novo"> Criar Evento</a></li>
              <li><a href="/administrador/editarEvento"> Editar Evento</a></li>
              <li><a href="/administrador/editar/permissao">Editar permissões</a></li>
            </ul>
          </li>
          <?php endif; ?>
          <!-- <li><a href="#" title="Download">Downloads</a></li> -->
          <!-- <li><a href="#" title="Recordações">Recordações</a></li> -->
        </ul>
        
        <div class="navbar-right margin_right" style="margin-right: 5px">   
          <ul class="nav navbar-nav ">
            <li class="dropdown"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                <!-- Exibe o nome do usuario logado -->
                <?php if(session()->has('pessoa_nome')): ?>
                <small> <?php echo e(session()->get('pessoa_nome')); ?>  </small>
                <?php else: ?> 
                Login expirou!
                <?php endif; ?>
                
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
              '/administrador/home',
              '/administrador/eventos/novo',
              '/administrador/cadastros_basicos/categorias',
              '/administrador/cadastros_basicos/areas',
              '/administrador/cadastros_basicos/criterios'
              );
              ?>
              <?php if(session()->has('evento_id') and in_array($_SERVER ['REQUEST_URI'], $array)): ?>
              <ul class="nav nav-tabs nav-justified" id="menu">
                <li role="presentation" id="selecionaevento" ><a href="/administrador/home" class=" hvr-wobble-horizontal">Selecionar evento</a></li>

                <li role="presentation" id="novoevento"><a href="/administrador/eventos/novo" class=" hvr-wobble-horizontal">Criar novo evento</a></li>
                
                <?php if($Eventos[0]->fim_submissao >= date('Y-m-d')): ?>
                <li role="presentation" id="categoria"><a href="/administrador/cadastros_basicos/categorias" class=" hvr-wobble-horizontal">Cadastrar categorias</a></li>
                <li role="presentation" id="area"><a href="/administrador/cadastros_basicos/areas" class=" hvr-wobble-horizontal">Cadastrar áreas</a></li>
                <li role="presentation" id="criterios"><a href="/administrador/cadastros_basicos/criterios" class=" hvr-wobble-horizontal">Cadastrar critérios de avaliação</a></li>
                <?php endif; ?>
              </ul>
              <?php elseif(in_array($_SERVER ['REQUEST_URI'], $array)): ?>
              <ul class="nav nav-tabs nav-justified" id="menu">
                <li role="presentation" id="selecionaevento" ><a href="/administrador/home" class=" hvr-wobble-horizontal">Selecionar evento</a></li>
                <li role="presentation" id="novoevento"><a href="/administrador/eventos/novo" class=" hvr-wobble-horizontal">Criar novo evento</a></li>
              </ul>
              <?php endif; ?>
            </nav>
          </div>
          <div class="row">

            <?php echo $__env->yieldContent('conteudo'); ?>
          </div>
        </div>
      </div>
    </main>
  </body>
  </html>
