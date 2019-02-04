<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>
        @hasSection('title') @yield('title') &dash; {{ config('app.name') }} @else {{ config('app.name') }} @endif</title>
</head>
<body class="font-sans antialiased text-black leading-normal">
<div id="app" class="min-h-screen flex flex-col">

    @hasSection('navbar')
        @include('components/navbar')
    @endif

    @yield('body')

</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
