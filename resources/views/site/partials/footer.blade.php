<footer class="footer">
    <div class="container d-flex justify-content-between">
        <div class="text-center">
            <div class="d-inline-flex">
                <a href="/" rel="home" class="logo-wrap" title="marie claire">
                    <svg class="logo logo--footer">
                        <use xlink:href="#logo"></use>
                    </svg>
                </a>
            </div>
            <div>
                @include('site.partials.social')
            </div>
        </div>
        <div class="footer_nav">
            <ul class="footer_nav-list">
                <li><a href="#">newsletter</a></li>
                @if(!empty($menu))
                    @foreach($menu as $link)
                        <li><a href="{{ url($link->link) }}">{{ $link->title }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</footer>
<div class="subfooter py-3">
    <div class="container d-flex flex-column flex-sm-row justify-content-between">
        <div class="text-center">&copy; {{date('Y')}} MarieClaire | All rights reserved.</div>
        <div class="text-center">Developed by <a href="https://ministudio.rs">Mini STUDIO Publishing Group</a></div>
    </div>
</div>