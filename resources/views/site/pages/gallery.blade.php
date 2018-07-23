@extends('site.layouts.main')

@section('content')
  <modal>
    <div class="modal_header">
      modal header
    </div>
    <div class="modal_body">
      body
    </div>
    <div class="modal_footer">
      footer
    </div>
  </modal>
  <div class="container pt-4">
    <h1 class="h4 text-serif text-capitalize mb-3">Article title and stuff</h1>

    <div class="content-wrap">

      <div class="content-main">
        <div class="d-flex justify-content-between py-2 border-top">
          <div></div>
          <toggler class-name="btn btn--secondary px-2" event="show:modal">
            <svg class="icon" role="presentation">
              <use xlink:href="#icon_gallery"></use>
            </svg>
            <span class="ml-1 d-none d-sm-inline">sve slike</span>
          </toggler>
        </div>
        <div class="mb-3 gallery">
          <div style="overflow-x: hidden;">
          <simple-carousel controls :index="0">

            <div class="slider-item">
              <slide
                src="https://images.pexels.com/photos/234881/pexels-photo-234881.jpeg?auto=compress&cs=tinysrgb&h=350"
                alt="more girls!"
              >
                <h2 class="text-sans-serif h6 mb-2">Some title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus obcaecati quo corporis quos molestias illum modi iste placeat.</p>
              </slide>
            </div>

            <div class="slider-item">
              <slide
                src="https://images.pexels.com/photos/37319/underwear-beauty-model-western-model-offered.jpg?auto=compress&cs=tinysrgb&h=350"
                alt="chick"
              >
                <h2 class="text-sans-serif h6 mb-2">Some title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus obcaecati quo corporis quos molestias illum modi iste placeat.</p>
              </slide>
            </div>

          </simple-carousel>
          </div>

        </div>

        <div class="mb-5 pt-2">
          <h2 class="h6 text-serif mb-3">Ne propustite</h2>

          <div class="row">
            @for($i = 0; $i < 6; $i++)
            <div class="col col--6">
              @related_item()
              @endrelated_item
            </div>
            @endfor
          </div>
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