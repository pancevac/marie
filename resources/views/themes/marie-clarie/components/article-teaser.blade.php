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
        <a href="{{ $post->getLink() }}" title="image alt">
            <div class="{{$image}} tint tint--light tint--hover"
                 data-src="{{ !empty($post->image)? ($isFeatured? url(\Imagecache::get($post->image, '650x278')->src) : url($post->image_box)) : '' }}"
                 data-alt="image alt"
            ></div>
        </a>
    </div>
    <div class="teaser_primary">
        <div class="{{$details}}">
            <a href="{{ $post->blog? $post->blog->first()->getLink() : '#' }}" class="details-item details-item--primary">{{ $post->blog? $post->blog->first()->title : '' }}</a>
            <span class="details-item details-item--secondary">{{ \Carbon\Carbon::parse($post->publish_at)->format('d/m/Y') }}</span>
        </div>
        <h3 class="teaser_title"><a href="{{ $post->getLink() }}">{{ $post->title }}</a></h3>
        <p class="{{$body}}">{{ $post->short }}</p>
    </div>
    @if($hasActions)
        <div class="teaser_actions">
            <a href="{{ $post->getLink() }}" class="btn btn--secondary">more</a>
        </div>
    @endif
</div>