@extends('themes.' . env('APP_THEME') . '.layouts.main')

@section('content')
    <div class="container pt-4">
        <h1 class="h4 text-serif text-capitalize">content</h1>
        <div class="content-wrap">
            <div class="content-main">
                @article_teaser([ 'featured' => true, 'actions' => true, 'post' =>  $latest->slice(0, 1)->first(), ]) @endarticle_teaser

                <div class="row">

                    @foreach($latest->slice(1) as $post)
                        <div class="col col--6">
                            @article_teaser([ 'actions' => true, 'post' => $post, ]) @endarticle_teaser
                        </div>
                    @endforeach

                </div>

                @include('themes.' . env('APP_THEME') . '.partials.pagination')

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