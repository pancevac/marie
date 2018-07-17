@php
  $isRoot = Request::is('/');
@endphp

@if($isRoot)
<div class="announcement"
  style="background-image: url(https://images.pexels.com/photos/355770/pexels-photo-355770.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260)"
>
  <div class="container announcement_container">
    <a href="/" style="color: inherit;">
      <svg class="logo logo--header">
        <use xlink:href="#logo"></use>
      </svg>
    </a>
  </div>
</div>
@endif

<header class="header">
  <div class="container header-wrap">
    
    <button class="icon-btn flex-shrink-0">
      <svg class="icon" role="presentation">
        <use xlink:href="#icon_menu"></use>
      </svg>
    </button>
  
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

    <button class="icon-btn header_search-icon">
      <svg class="icon" role="presentation">
        <use xlink:href="#icon_search"></use>
      </svg>
    </button>

  </div>
</header>