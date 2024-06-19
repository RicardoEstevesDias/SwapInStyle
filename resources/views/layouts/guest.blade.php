<!DOCTYPE html>
<html lang="fr" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'SwapInStyle') }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    @yield('body')
</body>

</html>
