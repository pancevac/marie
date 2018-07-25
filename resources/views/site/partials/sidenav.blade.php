<temporary-drawer>
  <div>
    <div class="p-4 d-flex align-items-center" style="color: white;">
      <a href="/" class="logo-wrap" title="Maria Claire logo">
        <svg class="logo logo--sidenav">
          <use xlink:href="#logo"></use>
        </svg>
      </a>
      <toggler class-name="icon-btn ml-auto"
        style="margin-right: -16px;"
        event="hide:drawer"
      >
        <svg class="icon" role="presentation" title="Hide sidenav">
          <use xlink:href="#icon_close"></use>
        </svg>
      </toggler>
    </div>
    <nav>
      <ul class="sidenav">
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">moda</a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">lepota</a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">lifestyle</a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">ljubav</a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">biznis</a>
        </li>
      </ul>
    </nav>

    <div>
      @include('site.partials.social')
    </div>
  </div>
</temporary-drawer>
