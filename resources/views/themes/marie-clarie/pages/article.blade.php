@extends('themes.' . env('APP_THEME') . '.layouts.main')

@section('content')
    <div class="container pt-4">
        <h1 class="h4 text-serif text-capitalize mb-3">{{ $post->title }}</h1>
        <div class="content-wrap">

            <div class="content-main">

                <div class="article pb-4"><!-- article -->

                    <div class="article_header">
                        <div class="image image--21-9"
                             data-src="{{ $post->image? url(\Imagecache::get($post->image, '650x278')->src) : '' }}"
                             data-alt="{{ $post->title }}"></div>
                        <div class="article_details">
                            author: {{ $post->user->name }},
                            datum: {{ \Carbon\Carbon::parse($post->publish_at)->format('d.m.Y.') }}
                        </div>
                    </div>

                    <div class="article_body">
                        {!! $post->content !!}
                    </div>

                    @if(!empty($post->gallery))
                        <div class="article_thumbs">
                            @image_gallery(['images' => $post->gallery, 'post' => $post]) @endimage_gallery
                        </div>
                    @endif

                </div><!-- ./article -->

                <div class="mb-5 pt-2">
                    <h2 class="h6 text-serif mb-3">Ne propustite</h2>

                    <div class="row">
                        @foreach($do_not_miss_it as $post)
                            <div class="col col--6">
                                @related_item(['post' => $post]) @endrelated_item
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