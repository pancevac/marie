@php
  $isRoot = Request::is('/');
@endphp

@if($isRoot)
<div class="announcement"
  style="background-image: url(https://images.pexels.com/photos/355770/pexels-photo-355770.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260)"
>
  <div class="container announcement_container">
    <a href="/" class="logo-wrap">
      <svg class="logo logo--header">
        <use xlink:href="#logo"></use>
      </svg>
    </a>
  </div>
</div>
@endif

<div class="top-bar">
  <div class="container top-bar_wrap">
    <a href="/" rel="home" class="logo-wrap" title="marie claire">
      <svg class="logo logo--header">
        <use xlink:href="#logo"></use>
      </svg>
    </a>
  </div>
</div>

<header class="header">
  <div class="container header-wrap">
  
    <toggler class-name="icon-btn flex-shrink-0" event="show:drawer">
      <svg class="icon" role="presentation" title="Toggle navigation">
        <use xlink:href="#icon_menu"></use>
      </svg>
    </toggler>

    <div class="px-1 d-none d-md-block">
      <a href="/" rel="home" class="logo-wrap" title="marie claire">
        <svg class="logo logo--nav">
          <use xlink:href="#logo"></use>
        </svg>
      </a>
    </div>

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

    <search-widget></search-widget>

  </div>
</header>