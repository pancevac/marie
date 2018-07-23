<footer class="footer">
  <div class="container d-flex justify-content-between">
    <div class="text-center">
      <div class="d-inline-flex">
        <a href="/" rel="home" class="logo-wrap" title="marie claire">
          <svg class="logo logo--footer">
            <use xlink:href="#logo"></use>
          </svg>
        </a>
      </div>
      <div>
        @include('site.partials.social')
      </div>
    </div>
    <div class="footer_nav">
      <ul class="footer_nav-list">
        <li><a href="#">newsletter</a></li>
        <li><a href="#">moda</a></li>
        <li><a href="#">lepota</a></li>
        <li><a href="#">lifestyle</a></li>
        <li><a href="#">ljubav</a></li>
        <li><a href="#">biznis</a></li>
        <li><a href="#">beauty box</a></li>
      </ul>
    </div>
  </div>
</footer>
<div class="subfooter py-3">
  <div class="container d-flex flex-column flex-sm-row justify-content-between">
    <div class="text-center">&copy; {{date('Y')}} MarieClaire | All rights reserved.</div>
    <div class="text-center">Developed by <a href="https://ministudio.rs">Mini STUDIO Publishing Group</a></div>
  </div>
</div>