<div class="image-grid">
  @foreach($images as $image)
  <a href="#" title="alt tag">
    <div class="image image--1-1 js-lazy-image"
      data-src={{$image}}
      data-alt="alt tag"
    ></div>
  </a>
  @endforeach
</div>