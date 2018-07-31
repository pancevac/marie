@extends('site.layouts.main')

@section('content')
  <div class="container pt-4">

    <div>

      <div>
        filters and stuff...
      </div>
      
      <div style="width: 66.6666%; margin-left: auto;">
        <div class="col mb-5">
          @for($i = 0; $i < 6; $i++)
          <div class="col">
            @shop_product()
            @endshop_product
          </div>
          @endfor
        </div>
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