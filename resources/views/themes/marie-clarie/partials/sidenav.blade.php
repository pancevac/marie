<temporary-drawer>
    <div>
        <div class="p-4 d-flex align-items-center" style="color: white;">
            <a href="{{ url('/') }}" class="logo-wrap" title="Maria Claire logo">
                <svg class="logo logo--sidenav">
                    <use xlink:href="#logo"></use>
                </svg>
            </a>
            <toggler class="icon-btn ml-auto"
                     style="margin-right: -16px;"
                     event="hide:drawer"
            >
                <svg class="icon" role="presentation" title="Hide sidenav">
                    <use xlink:href="#icon_close"></use>
                </svg>
            </toggler>
        </div>
        <nav>
            <ul class="sidenav">
                @if(!empty($menu))
                    @foreach($menu as $link)
                        <li class="sidenav-item">
                            <a class="sidenav-link" href="{{ url($link->link) }}">{{ $link->title }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>

        <div>
            @include('themes.' . env('APP_THEME') . '.partials.social')
        </div>
    </div>
</temporary-drawer>
