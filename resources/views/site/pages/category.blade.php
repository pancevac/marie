@extends('site.layouts.main')

@section('content')
  <div class="container pt-4">
    <h1 class="h4 text-serif text-capitalize">content</h1>
    <div class="content-wrap">  
      <div class="content-main">

        @article_teaser([
          'featured' => true,
          'actions' => true,
        ])
        @endarticle_teaser

        <div class="row">
          
          @for($i = 0; $i < 6; $i++)
          <div class="col col--6">
            @article_teaser([
              'actions' => true,
            ])
            @endarticle_teaser
          </div>
          @endfor
          
        </div>

        @include('site.partials.pagination')

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
        <div class="aside-box" style="width:100%; padding-top: 100%; background:hotpink;"></div>
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