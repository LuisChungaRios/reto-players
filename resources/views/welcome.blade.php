<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
    </head>
    <body>
        <div class="container-fluid p-4" >
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Listado de jugadores</h2>
                </div>
            </div>
            <main class="row" id="app">
                <the-team></the-team>
            </main>

        </div>

        <script src="{{ asset('js/app.js')  }}"></script>
    </body>
</html>

