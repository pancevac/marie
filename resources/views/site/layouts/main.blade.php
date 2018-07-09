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
  <div id="app" class="content">
    <my-header></my-header>

    @yield('content')
  </div>
  <footer class="footer">
    footer
  </footer>
  <script src="{{ url('client/scripts/main.js') }}"></script>
</body>
</html>