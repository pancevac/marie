@extends('site.layouts.main')

@section('content')
  <div class="container">
    <div class="content-wrap">  
      <div class="content-main">
        <h1>main stuff</h1>
        <button class="btn">button</button>
        <a href="#" class="btn">link</a>
        
        <div class="image image--21-9 js-lazy-image"
          data-src="http://www.marieclaire.cz/sites/default/files/styles/610x300/public/images/vuitton_unicef_masthead_landscape-1600w_0.jpg?itok=t58_V63v&c=62b3fccd430a72c4837d98721097b76d"
          data-alt="image alt"
        ></div>
      </div>
      <aside class="content-aside">side stuff</aside>
    </div>
  </div>
@endsection