@extends('site.layouts.beautybox')

@section('content')
  <div style="background-color: powderblue;">
    <div class="container" style="height: 464px;">
      hero image and stuff...
    </div>
  </div>
  <div class="container">
    <div>
      <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, praesentium? Qui voluptatem corporis in error repudiandae dignissimos inventore repellat. Eligendi esse voluptatum vitae distinctio, dignissimos pariatur tempore harum voluptas amet?</p>
    </div>
    <h2 class="text-uppercase text-center mb-4 h5">sadržaj beauty box-a</h2>

    <div class="beautybox-products">
      @for($i = 0; $i < 5; $i++)
      <div class="beautybox-products_item">
        @beautybox_product()
        @endbeautybox_product
      </div>
      @endfor
    </div>

    <h2 class="text-uppercase text-center mb-4 h5">partneri</h2>

    <div>
      partners and stuff...
    </div>

    <h2 class="h6">#beautybox</h2>

    <div>
      instagram plugin and stuff...
    </div>

    <div class="text-center py-5 small">
      <div>Legal crap and stuff</div>
      <div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum rerum hic quas! Atque nostrum dolores excepturi!</div>
    </div>

  </div>
@endsection