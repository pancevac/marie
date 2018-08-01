<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="{{ url('client/styles/main.css') }}">
</head>
<body>
  @include('site.partials.graphics')

  <div id="app" class="content">
    @include(env('APP_THEME') . '.partials.sidenav')
    @include(env('APP_THEME') . '.partials.header')

    @yield('content')
  </div>
  @include(env('APP_THEME') . '.partials.footer')
  <script src="{{ url('client/scripts/main.js') }}"></script>
</body>
</html>