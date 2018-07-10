@extends('site.layouts.main')

@section('content')
  <div class="container">
    <h1>content</h1>
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

      </div>
      <aside class="content-aside">
        <div class="aside-box" style="width:300px; height:300px; background:hotpink;">banner</div>
        <div class="aside-box">
          @include('site.partials.newsletter')
        </div>
      </aside>
    </div>
  
  </div>
@endsection