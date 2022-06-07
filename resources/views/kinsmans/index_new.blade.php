@extends('layouts.app')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
@endsection
@push('styles')
    <style>
        .team-boxed {
            color:#313437;
            background-color:#eef4f7;
        }

        .team-boxed p {
            color:#7d8285;
        }

        .team-boxed h2 {
            font-weight:bold;
            margin-bottom:40px;
            padding-top:40px;
            color:inherit;
        }

        @media (max-width:767px) {
            .team-boxed h2 {
                margin-bottom:25px;
                padding-top:25px;
                font-size:24px;
            }
        }

        .team-boxed .intro {
            font-size:16px;
            max-width:500px;
            margin:0 auto;
        }

        .team-boxed .intro p {
            margin-bottom:0;
        }

        .team-boxed .people {
            padding:50px 0;
        }

        .team-boxed .item {
            text-align:center;
        }

        .team-boxed .item .box {
            text-align:center;
            padding:30px;
            background-color:#fff;
            margin-bottom:30px;
            min-height: 400px;
        }

        .team-boxed .item .name {
            font-weight:bold;
            margin-top:28px;
            margin-bottom:8px;
            color:inherit;
        }

        .team-boxed .item .title {
            text-transform:uppercase;
            font-weight:bold;
            color:#d0d0d0;
            letter-spacing:2px;
            font-size:13px;
        }

        .team-boxed .item .description {
            font-size:15px;
            margin-top:15px;
            margin-bottom:20px;
        }

        .team-boxed .item img {
            max-width:160px;
        }

        .team-boxed .social {
            font-size:18px;
            color:#a2a8ae;
        }

        .team-boxed .social a {
            color:inherit;
            margin:0 10px;
            display:inline-block;
            opacity:0.7;
        }

        .team-boxed .social a:hover {
            opacity:1;
        }
    </style>
@endpush
@section('content')
    <div class="team-boxed">
        <div class="container">
            <div class="row people">
                @foreach($models as $kinsman)
                    @php /** @var \App\Models\Kinsman $kinsman */ @endphp
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $kinsman->id) }}"><img class="rounded-circle" src="assets/img/1.jpg" alt="{{ $kinsman->name }}"></a>
                            <h3 class="name">{{ $kinsman->getFullNameAttribute() }}</h3>
                            @if(!empty($kinsman->life->birth_date))
                                <p class="title">{{ Carbon\Carbon::make($kinsman->life->birth_date)->format('j F Y') }}</p>
                            @endif
                            @if(!empty($kinsman->kin->name))
                                <p class="description">{{ $kinsman->kin->name }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $models->onEachSide(5)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
@endpush
