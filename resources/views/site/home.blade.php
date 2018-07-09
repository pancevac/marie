@extends('site.layouts.main')

@section('content')
  <div class="container">
    <div class="content-wrap">  
      <div class="content-main">
        <h1>main stuff</h1>
        <button class="btn">button</button>
        <a href="#" class="btn">link</a>
        <input type="button" value="input" class="btn">
        <button class="btn btn--primary">button</button>
      </div>
      <aside class="content-aside">side stuff</aside>
    </div>
  </div>
@endsection