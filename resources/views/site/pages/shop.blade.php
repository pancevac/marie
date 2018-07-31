@extends('site.layouts.main')

@section('content')
  <div class="container pt-4">

    <div>

      <div>
        shop items and stuff...
      </div>

      <div>
        filters and stuff...
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
@endsection