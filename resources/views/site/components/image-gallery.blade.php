<div class="image-grid">
  @foreach($images as $image)
  <a href="#">
    <div class="image image--1-1 js-lazy-image"
      data-src={{$image}}
    ></div>
  </a>
  @endforeach
</div>