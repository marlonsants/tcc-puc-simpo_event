<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="/css/hover.css" rel="stylesheet" media="all">
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script src="/js/chart/Chart.js"></script>

    <title>Exemplos de graficos</title>

    {!! Charts::assets() !!}

</head>

<body>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-6 col-xs-6">
            {!! $chart1->render() !!}      
        </div>

        <div class="col-md-6 col-xs-6">
            {!! $chart2->render() !!}      
        </div>
    </div><br><br><br>

    <div class="row">
        <div class="col-md-3 col-xs-3">
            {!! $chart3->render() !!}      
        </div>

        <div class="col-md-3 col-xs-3">
            {!! $chart4->render() !!}      
        </div>

        <div class="col-md-3 col-xs-3">
            {!! $chart5->render() !!}   
        </div>

        <div class="col-md-3 col-xs-3">
            {!! $chart6->render() !!}   
        </div>
    </div>
</div>

</body>

</html>