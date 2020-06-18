<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skina T</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="center-page">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Descripción</div>
                        <div class="card-body">
                            La aplicación decidí construirla con laravel por razones de eficiencia, y presentación.
                            La estructura Model View Model, la división clara entre el Front end y El Back end fueron claves para tomar este framework como candidato ideal
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Aplicación</div>
                        <div class="card-body">
                            <a class="btn btn-secondary" href="{{ route('login') }}">Iniciar aplicativo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>