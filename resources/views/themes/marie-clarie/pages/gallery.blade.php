@extends('themes.' . env('APP_THEME') . '.layouts.main')

@section('content')
    <div class="container pt-4">
        <h1 class="h4 text-serif text-capitalize mb-3">{{ $post->title }}</h1>

        <div class="content-wrap">

            <div class="content-main">
                <div class="d-flex justify-content-between py-2 border-top">
                    <div></div>
                    <a class="btn btn--secondary px-2" href="{{ $post->getImagesLink() }}">
                        <svg class="icon" role="presentation">
                            <use xlink:href="#icon_gallery"></use>
                        </svg>
                        <span class="ml-1 d-none d-sm-inline">sve slike</span>
                    </a>
                </div>
                @if(!empty($post->gallery))
                <div class="mb-3 gallery">
                    <div style="overflow-x: hidden;">
                        <simple-carousel controls :index="0">

                            @foreach($post->gallery as $image)

                                <div class="slider-item">
                                    <slide src="{{ url($image->file_path) }}" alt="{{ $image->title }}">
                                        <h2 class="text-sans-serif h6 mb-2">{{ $image->title }}</h2>
                                        <p>{{ $image->desc }}</p>
                                    </slide>
                                </div>

                            @endforeach

                        </simple-carousel>
                    </div>
                </div>
                @endif

                <div class="mb-5 pt-2">
                    <h2 class="h6 text-serif mb-3">Ne propustite</h2>

                    <div class="row">
                        @foreach($do_not_miss_it as $article)
                            <div class="col col--6">
                                @related_item(['post' => $article])@endrelated_item
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <aside class="content-aside">
                <div class="aside-box" style="width:100%; padding-top: 100%; background:hotpink;"></div>
                <div class="aside-box">
                    @include('themes.' . env('APP_THEME') . '.partials.subscription')
                </div>
                <div class="aside-box">
                    @include('themes.' . env('APP_THEME') . '.partials.newsletter')
                </div>
            </aside>

        </div>

    </div>
@endsection