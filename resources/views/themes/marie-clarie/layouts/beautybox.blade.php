<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Marie Claire</title>
  <link rel="stylesheet" href="{{ url('client/styles/main.css') }}">
</head>
<body>
  @include('site.partials.graphics')

  <div id="app" class="content">
    @include('site.partials.sidenav')
    @include('site.partials.beautybox.header')

    @yield('content')
  </div>
  @include('site.partials.footer')
  <script src="{{ url('client/scripts/main.js') }}"></script>
</body>
</html>