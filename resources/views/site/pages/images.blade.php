@extends('site.layouts.main')

@section('content')
  <div class="container pt-4">
    <h1 class="h4 text-serif text-capitalize mb-3">Article title and stuff</h1>

    <div class="content-wrap">

      <div class="content-main">
        <div class="mb-3 gallery">
          
          @image_gallery([
            'images' => [
              'https://images.pexels.com/photos/903171/pexels-photo-903171.jpeg?auto=compress&cs=tinysrgb&h=350',
              'https://images.pexels.com/photos/866027/pexels-photo-866027.jpeg?auto=compress&cs=tinysrgb&h=350',
              'https://images.pexels.com/photos/907826/pexels-photo-907826.jpeg?auto=compress&cs=tinysrgb&h=350',
              'https://images.pexels.com/photos/905336/pexels-photo-905336.jpeg?auto=compress&cs=tinysrgb&h=350',
              'https://images.pexels.com/photos/866019/pexels-photo-866019.jpeg?auto=compress&cs=tinysrgb&h=350',
            ],
          ])
          @endimage_gallery

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
