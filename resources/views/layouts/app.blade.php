<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portfolio | @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css' integrity='sha512-8BU3emz11z9iF75b10oPjjpamM4Mz23yQFQymbtwyPN3mNWHxpgeqyrYnkIUP6A8KyAj5k2p3MiYLtYqew7gIw==' crossorigin='anonymous'/>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>

    @include('admin.partials.header')

    <div class="my_wrapper">

        @auth
            <div class="my_sidebar">
                @include('admin.partials.sidebar')
            </div>
        @endauth

        <div class="my_container">
            @yield('content')
        </div>

    </div>

    @include('admin.partials.footer')

</body>

</html>
