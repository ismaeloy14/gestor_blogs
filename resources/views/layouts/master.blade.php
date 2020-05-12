<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestor Blogs</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gestor_blogs.css') }}">
</head>
<body>

    <div id="container">
        @include('layouts.header')

        @yield('body')

        @include('layouts.footer')
    </div>
</body>
</html>

