<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings->title }}</title>
    <link rel="stylesheet" href="{{ url('client/styles/main.css') }}">
</head>
<body>
@include('themes.' . env('APP_THEME') . '.partials.graphics')

<div id="app" class="content">
    @include('themes.' . env('APP_THEME') . '.partials.sidenav')
    @include('themes.' . env('APP_THEME') . '.partials.header')

    @yield('content')
</div>
@include('themes.' . env('APP_THEME') . '.partials.footer')
<script src="{{ url('client/scripts/main.js') }}"></script>
</body>
</html>