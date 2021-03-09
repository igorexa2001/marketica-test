<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        @yield('extra_css')
    </head>

    <body class="d-flex flex-column h-100">
        <header>
            @include('layout.navbar')
        </header>

        <main role="main" class="flex-fill">
            @yield('content')
        </main>

        @include('layout.footer')

    </body>

    @yield('extra_js')
</html>
