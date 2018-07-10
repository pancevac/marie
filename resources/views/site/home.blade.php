@extends('site.layouts.main')

@section('content')
  <div class="container">
    <div class="content-wrap">  
      <div class="content-main">
        <h1>main stuff</h1>
        <button class="btn">button</button>
        <a href="#" class="btn">link</a>
        
        @article_teaser([
          'featured' => true,
        ])
        @endarticle_teaser

        <div style="width: 50%;">
          @article_teaser()
          @endarticle_teaser
        </div>
      </div>
      <aside class="content-aside">side stuff</aside>
    </div>
  </div>
@endsection