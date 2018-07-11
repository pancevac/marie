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
    <header class="header">
      <div class="container header-wrap">

        <tab-bar>
          <div class="nav-item">
            <a class="nav-link" href="#">moda</a>
          </div>
          <div class="nav-item">
            <a class="nav-link" href="#">lepota</a>
          </div>
          <div class="nav-item">
            <a class="nav-link" href="#">lifestyle</a>
          </div>
          <div class="nav-item">
            <a class="nav-link" href="#">ljubav</a>
          </div>
          <div class="nav-item">
            <a class="nav-link" href="#">biznis</a>
          </div>
        </tab-bar>

      </div>
    </header>

    @yield('content')
  </div>
  <footer class="footer">
    footer
  </footer>
  <script src="{{ url('client/scripts/main.js') }}"></script>
</body>
</html>