<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="domain" content="{{ url('/') }}">

    <title>Marie Claire</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="app">
    <app></app>
</div>

<!-- Scripts -->
{{--<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>--}}
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>