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
    @include('layouts.navbar')

    @hasSection("profile")
        <div class="mb-10">
            @yield("profile")
        </div>
    @endif

    <div class="container">
        @include('components.flash')
        @yield('body')
    </div>
</body>

</html>
