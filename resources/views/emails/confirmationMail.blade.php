<link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">


<div style="background-color:#fff; width: 60%;margin-left: 15%; margin-right: 15%; margin-bottom: 3em">

    <div>
        <div style="margin:     auto">
            <h1 style="color: #75405e; text-align: center; font-family: poppins;font-size: 2em;"> Registro efetuado com
                sucesso!</h1>
        </div>

    </div>
    <br>
    <div>
        <h2 style="font-weight: bolder; text-align: center; font-family: poppins;font-size: 2em">
            Olá, {{$register['nome']}} seu registro já foi efetuado em nossa base de dados, confirme seu email clicando no link abaixo.
        </h2>

        <a href="{{route('register.activate',['email'=>$register['email']])}}">
            <p style="font-weight: 100;font-size: 1.7em; text-align: center; font-family: poppins">
                Confirmar Email
            </p>
        </a>
    </div>

</div>

