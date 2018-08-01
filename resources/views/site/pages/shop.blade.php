@extends('site.layouts.main')

@section('content')
  <div class="container">

    <div>

      <div class="filters">

        <div class="filters_head with-action">
          <span>Filteri</span>
          <span class="icon">&#9660;</span>
        </div>

        <div class="filters_body">

          <div class="filter"><!-- filter -->
            <div class="filter_name">Filter name</div>
            <ul class="filter_list">
              <li class="filter_list-item">filte value</li>
              <li class="filter_list-item">filte value</li>
              <li class="filter_list-item">filte value</li>
            </ul>
          </div><!-- ./filter -->

        </div>

      </div>
      
      <div>
        <div class="row shop-list mb-4">
          @for($i = 0; $i < 6; $i++)
          <div class="col shop-list_item">
            @shop_product()
            @endshop_product
          </div>
          @endfor
        </div>

        @include('site.partials.pagination')
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