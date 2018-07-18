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

    <div class="container">
      <nav aria-label="page navigation">
        <ul class="pagination pagination-sm">
          <li class="page-item disabled">
            <a class="page-link" href="#">
              <span aria-hidden="true">&laquo;</span>
              <span>predhodna</span>
            </a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">
              <span>sledeća</span>
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  
  </div>
@endsection