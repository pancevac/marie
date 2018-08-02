<div class="related-item">
  <a href="{{ $post->getLink() }}" title="{{ $post->title }}">
    <div class="js-lazy-image image image--16-9 tint tint--light tint--hover"
      data-src="{{ !empty($post->image)? url(\Imagecache::get($post->image, '308x173')->src) : '' }}"
      data-alt="{{ $post->title }}"
    ></div>
  </a>
  <div class="related-item_label">
    <a href="{{ $post->blog? $post->blog->first()->getLink() : '#' }}">{{ $post->blog? $post->blog->first()->title : '' }}</a>
  </div>
  <div class="related-item_title text-serif">
    <a href="{{ $post->getLink() }}">{{ $post->title }}</a>
  </div>
</div>