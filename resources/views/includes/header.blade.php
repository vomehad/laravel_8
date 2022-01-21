<header class="header-content">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        @if(isset($title))
            <a href="<?= route('Home') ?>" class="my-0 mr-md-auto font-weight-normal text-decoration-none">
                <span class="fs-4">{{ $title }}</span>
            </a>
        @endif

        @if(isset($nav) && !empty($nav))
            <nav class="my-2 my-md-0 mr-md-3 nav-content">
                @foreach($nav as $link)
                    <a class="p-2 text-dark text-decoration-none"
                       href="{{ $link['url'] }}"
                    >{{ $link['name'] }}</a>
                @endforeach
                    <a class="btn btn-outline-primary" href="#">Sign up</a>
            </nav>
        @endif
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        @if(isset($title))
        <h1 class="display-4 fw-normal">{{ $title }}</h1>
        @endif
    </div>
</header>
