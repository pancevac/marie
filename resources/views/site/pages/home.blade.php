@extends('site.layouts.main')

@section('content')
  <div class="container">

    @include('site.partials.masthead')
    
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
        <div class="aside-box" style="width:100%; padding-top: 100%; background:hotpink;"></div>
        <div class="aside-box">
          @include('site.partials.subscription')
        </div>
        <div class="aside-box">
          @include('site.partials.newsletter')
        </div>
      </aside>
    </div>

    <!-- most read -->
    <div style="border-bottom: 2px solid #222; margin-bottom: 32px;">
      <h2 class="title title--lines mb-4">Najčitaniji članci</h2>

      <div class="home-popular">

        <simple-carousel>
          @for($i = 0; $i < 4; $i++)
          <div class="slider-item home-popular_item">
            <a href="#" title="alt tag">
              <div class="js-lazy-image image image--1-1 tint tint--light tint--hover"
                data-src=""
                data-alt="alt tag"
              ></div>
            </a>
            <div class="home-popular_title">
              <a href="#">Popular article title, medium long...</a>
            </div>
          </div>
          @endfor
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