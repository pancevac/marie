@extends('site.layouts.main')

@section('content')
    <div class="container">

        @include('site.partials.masthead')

        <div class="content-wrap">
            <div class="content-main">

                @foreach($latest->slice(0, 3) as $post)
                    @article_teaser([ 'post' => $post, 'featured' => true, ]) @endarticle_teaser
                @endforeach

            </div>
            <aside class="content-aside">
                <div class="aside-box" style="width:100%; padding-top: 100%; background:hotpink;"></div>
                <div class="aside-box">
                    @include('site.partials.subscription')
                </div>
                <div class="aside-box">
                    @include('site.partials.newsletter')
                </div>
            </aside>
        </div>

        <!-- most read -->
        <div style="border-bottom: 2px solid #222; margin-bottom: 32px;">
            <h2 class="title title--lines mb-4">Najčitaniji članci</h2>

            <div class="home-popular">

                <simple-carousel>
                    @foreach($most_views as $most)
                        <div class="slider-item home-popular_item">
                            <a href="{{ $most->getLink() }}" title="alt tag">
                                <div class="js-lazy-image image image--1-1 tint tint--light tint--hover"
                                     data-src="{{ $most->image_box }}"
                                     data-alt="alt tag"
                                ></div>
                            </a>
                            <div class="home-popular_title">
                                <a href="{{ $most->getLink() }}">{{ $most->title }}</a>
                            </div>
                        </div>
                    @endforeach
                </simple-carousel>
            </div>
        </div>

        <div class="content-wrap">
            <div class="content-main">
                <div class="row">

                    @foreach($latest->slice(3) as $post)
                        <div class="col col--6">
                            @article_teaser(['post' => $post]) @endarticle_teaser
                        </div>
                    @endforeach

                </div>
            </div>
            <aside class="content-aside"></aside>
        </div>
    </div>
@endsection