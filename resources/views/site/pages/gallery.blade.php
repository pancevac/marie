@extends('site.layouts.main')

@section('content')
  <div class="container pt-4">
    <h1 class="h4 text-serif text-capitalize mb-3">Article title and stuff</h1>

    <div class="content-wrap">

      <div class="content-main">
        <div>show gallery stuff and crap...</div>
        <div class="mb-3" style="overflow-x: hidden;">
          <simple-carousel>

            <div class="slider-item">
              <div class="slide slide--landscape">
                <div class="slide_image">
                  <div class="image image--16-9"></div>
                </div>
                <div class="p-3 slide_info" style="background-color: #f7f7f7;">
                  <h2 class="text-sans-serif h6 mb-2">Image title</h2>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus obcaecati quo corporis quos molestias illum modi iste placeat.</p>
                </div>
              </div>
            </div>

            <div class="slider-item">
              <div class="slide slide--portrait">
                <div class="slide_image">
                  <div class="image image--3-4"></div>
                </div>
                <div class="p-3 slide_info" style="background-color: #f7f7f7;">
                  <h2 class="text-sans-serif h6 mb-2">Image title</h2>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus obcaecati quo corporis quos molestias illum modi iste placeat.</p>
                </div>
              </div>
            </div>

          </simple-carousel>

        </div>
      </div>

      <aside class="content-aside">
        <div class="aside-box" style="width:300px; height:300px; background:hotpink;">banner</div>
        <div class="aside-box">
          @include('site.partials.subscription')
        </div>
        <div class="aside-box">
          @include('site.partials.newsletter')
        </div>
      </aside>

    </div>

  </div>
@endsection