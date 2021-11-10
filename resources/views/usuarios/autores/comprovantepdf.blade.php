<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <style type="text/css">

      body {
        border: 3px solid grey; border-radius: 30%;
        background: url('/images/selo.png') no-repeat center center #E0FFFF;
        font: sans-serif;
      }
      header {margin: 2%; margin-top: -1%}
      .dados {margin: 2%; font-size: 16px;}
    </style>

  </head>
  <body>

  <main>

    <header>
      @foreach($dadosEvento as $evento)
      <center><h1 style="font-size: 45px;"><u>{{ $evento->nome_evento }}</u></h1></center>
      @endforeach
      <center><h1 style="margin-top: -1%;"><u>Certificado de aprovação do trabalho:</u></h1></center>
      <center><h3>Parabenizamos ao(s) autor(es) pela aprovação deste trabalho em nosso evento!<br>Agradecemos a sua participação!</h3></center>
    </header>

    <div class="dados">
      @foreach($dadosTrabalho as $trabalho)
      <div><b>Titulo do Artigo: </b>  {{ $trabalho->titulo }}</div>
      <div><b>Categoria: </b> {{ $trabalho->categoria_nome }}</div>
      <div><b>Area: </b> {{ $trabalho->area_nome }}</div>
      <div><b>Situação: </b> Aprovado</div>
      @endforeach

      @foreach($dadosEvento as $evento)
      <div><b>Data do Inicio Evento: </b> {{ $inicio_evento }}</div>
      <div><b>Data do Fim Evento: </b> {{ $fim_evento }}</div>
      <div><b>Local do Evento: </b> {{ $evento->local_evento }}</div>
      @endforeach
    </div>

    <div class="dados">
      <div><u><b>Autor(es) do Trabalho:</b></u></div>
      @foreach($dadosPessoa as $pessoa)
      <div><b>Autor: </b> {{ $pessoa->nome }} {{ $pessoa->sobrenome }}</div>
      <div><b>CPF: </b> {{ $pessoa->numero_documento }}</div>
      <div><b>Filiação: </b> {{ $pessoa->instituicao }}</div>
      <br/>
      @endforeach 
    </div>

  </main>

  </body>
</html>