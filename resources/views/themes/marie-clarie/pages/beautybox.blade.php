@extends('site.layouts.beautybox')

@section('content')
  <div class="py-4" style="background-color: #b5e2f5;">
    @beautybox_hero()
    @endbeautybox_hero
  </div>

  <div class="container">

    <div class="mb-5">
      <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, praesentium? Qui voluptatem corporis in error repudiandae dignissimos inventore repellat. Eligendi esse voluptatum vitae distinctio, dignissimos pariatur tempore harum voluptas amet?</p>
      <div class="text-center">
        <img src="http://beautybox.marieclaire.cz/imgs/marieclaire_sig.png" alt="marie claire signature">
      </div>
    </div>

    <h2 class="text-uppercase text-center mb-4 h5">sadržaj beauty box-a</h2>

    <div class="row mb-5">
      @for($i = 0; $i < 6; $i++)
      <div class="col beautybox-list_item">
        @beautybox_product()
        @endbeautybox_product
      </div>
      @endfor
    </div>

    <h2 class="text-uppercase text-center mb-4 h5">partneri</h2>

    <div class="row mb-5">
      @for($i = 0; $i < 6; $i++)
      <div class="col beautybox-list_item">
        @beautybox_partner()
        @endbeautybox_partner
      </div>
      @endfor
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