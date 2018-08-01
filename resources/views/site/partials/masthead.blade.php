<div class="masthead">
    <simple-carousel dots loop>

    @if(!empty($slider))
        @foreach($slider as $post)
            <div class="slider-item masthead-item-wrap">
                <div class="masthead-item">
                    <div class="masthead-item_content">
                        <a class="details-item details-item--primary" href="{{ $post->blog->first()->getLink() }}">{{ $post->blog->first()->title }}</a>
                        <div class="masthead-item_title"><a href="{{ $post->getLink() }}">{{ $post->title }}</a></div>
                    </div>
                    <div class="masthead-item_image">
                        <a href="{{ $post->getLink() }}" title="alt tag">
                            <div class="image image--16-9 js-lazy-image"
                                data-src="{{ $post->image? url($post->image) : '' }}"
                                data-alt="{{ $post->title }}"
                            ></div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    </simple-carousel>

</div>