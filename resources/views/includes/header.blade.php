<header class="header-content">
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        @if(isset($title))
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">{{$title}}</span>
            </a>
        @endif

        @if(isset($nav) && !empty($nav))
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav-content">
                @foreach($nav as $link)
                    <a class="me-3 py-2 text-dark text-decoration-none"
                       href="{{$link['url']}}"
                    >{{$link['name']}}</a>
                @endforeach
            </nav>
        @endif
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        @if(isset($title))
        <h1 class="display-4 fw-normal">{{$title}}</h1>
        @endif
    </div>
</header>
