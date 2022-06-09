@extends('layouts.app')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@push('styles')
    <style>
        .team-boxed {
            color: #313437;
            background-color: #eef4f7;
        }

        .team-boxed p {
            color: #7d8285;
        }

        .team-boxed .people {
            padding: 50px 0;
        }

        .team-boxed .item {
            text-align: center;
        }

        .team-boxed .item .box {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            margin-bottom: 30px;
            min-height: 400px;
        }

        .team-boxed .item .name {
            /*font-weight: bold;*/
            margin-top: 28px;
            margin-bottom: 8px;
            color: black;
        }

        .team-boxed .item .title {
            text-transform: uppercase;
            /*font-weight: bold;*/
            color: #0c0505;
            letter-spacing: 2px;
            font-size: 11px;
        }

        .team-boxed .item .description {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 20px;
            color: black;
        }

        .team-boxed .item img {
            max-height: 150px;
        }

        .info-wrap {
            min-height: 150px;
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
                            <a href="{{ route('kinsmans.show', $kinsman->id) }}">
                                <img class="rounded-circle" src="{{ $kinsman->presenter()->image() }}">
                            </a>
                            <div class="info-wrap" {!! $kinsman->presenter()->color() !!}>
                                <a href="{{ route('kinsmans.show', $kinsman->id) }}">
                                    <h4 class="name">{{ $kinsman->presenter()->title() }}</h4>
                                </a>
                                @if(!empty($kinsman->life->birth_date))
                                    <p class="title">{{ $kinsman->presenter()->birthDate() }}</p>
                                @endif
                                @if(!empty($kinsman->kin->name))
                                    <p class="description">{{ $kinsman->kin->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <p>{{ $models->onEachSide(5)->links() }}</p>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
@endpush
