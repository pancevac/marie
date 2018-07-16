@extends('site.layouts.main')

@section('content')
  <div class="container">
    <h1>content</h1>
    <div class="content-wrap">  
      <div class="content-main">
        
        @for($i = 0; $i < 3; $i++)
        @article_teaser([
          'featured' => true,
        ])
        @endarticle_teaser
        @endfor

      </div>
      <aside class="content-aside">
        <div class="aside-box" style="width:300px; height:300px; background:hotpink;">banner</div>
        <div class="aside-box">
          @include('site.partials.newsletter')
        </div>
      </aside>
    </div>

    <!-- most read -->
    <div style="border-bottom: 2px solid #222; margin-bottom: 32px;">
      <h2 class="title title--lines">Najčitaniji članci</h2>

      <div class="home-popular">

        <simple-carousel>
          <div class="home-popular_item">
            <a href="/hello">
              <div class="image image--1-1"></div>
            </a>
            <a href="/hello">hello</a>
          </div>
          <div class="home-popular_item">
            <a href="/world">
              <div class="image image--1-1"></div>
            </a>
            <a href="/world">world</a>
          </div>
        </simple-carousel>
      </div>
    </div>

    <div class="content-wrap">
      <div class="content-main">
        <div class="row">
          
          @for($i = 0; $i < 6; $i++)
          <div class="col col--6">
            @article_teaser()
            @endarticle_teaser
          </div>
          @endfor
          
        </div>
      </div>
      <aside class="content-aside"></aside>
    </div>
  </div>
@endsection