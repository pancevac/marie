@extends('site.layouts.main')

@section('content')
  <div class="container">
    <h1>content</h1>
    <div class="content-wrap">  
      <div class="content-main">
        
        @article_teaser([
          'featured' => true,
        ])
        @endarticle_teaser
        
        @article_teaser([
          'featured' => true,
        ])
        @endarticle_teaser
        
        @article_teaser([
          'featured' => true,
        ])
        @endarticle_teaser

      </div>
      <aside class="content-aside">
        <div style="width:300px; height:300px; background:hotpink;">banner</div>
      </aside>
    </div>

    <h2 class="title title--lines">section title</h2>
  </div>
@endsection