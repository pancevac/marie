@php
  $isFeatured = isset($featured) ? $featured : false;
  $hasActions = isset($actions) ? $actions : false;
  $teaser = 'teaser'.($isFeatured ? ' teaser--featured' : '');
  $image = 'image js-lazy-image image--'.($isFeatured ? '21-9' : '1-1');
  $details = 'details'.($isFeatured ? ' details--fixed' : '');
  $body = 'teaser_body'.(!$isFeatured ? ' text-truncate' : '');
@endphp

<div class="{{$teaser}}">
  <div class="teaser_media">
    <a href="#">
      <div class="{{$image}} tint tint--light tint--hover"
        data-src=""
        data-alt="image alt"
      ></div>
    </a>
  </div>
  <div class="teaser_primary">
    <div class="{{$details}}">
      <a href="#" class="details-item details-item--primary">category</a>
      <span class="details-item details-item--secondary">12/3/2018</span>
    </div>
    <h3 class="teaser_title"><a href="#">Article title</a></h3>
    <p class="{{$body}}">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero qui, dignissimos voluptas maiores voluptatem adipisci. Itaque reprehenderit maxime iure repellendus libero fugit, sequi esse rem molestias velit, ea perferendis recusandae..</p>
  </div>
  @if($hasActions)
  <div class="teaser_actions">
    <a href="#" class="btn btn--secondary">more</a>
  </div>
  @endif
</div>