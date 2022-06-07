@extends('layouts.app')
@push('styles')
    <style>
        img {
            max-width: 100%;
            max-height: 100%;
        }

        h1 {
            font-size: 50px;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }
    </style>
    <style>
        .child-box {
            font-weight:bold;
            margin-bottom:40px;
            padding-top:40px;
            color:inherit;
        }

        @media (max-width:767px) {
            .child-box {
                margin-bottom:25px;
                padding-top:25px;
                font-size:24px;
            }
        }

        .people {
            padding:50px 0;
        }

        .item {
            text-align:center;
        }

        .item .box {
            text-align:center;
            padding:30px;
            background-color:#fff;
            margin-bottom:30px;
            min-height: 400px;
        }

        .item .name {
            font-weight:bold;
            margin-top:28px;
            margin-bottom:8px;
            color:inherit;
            min-height: 80px;
        }

        .item .title {
            text-transform:uppercase;
            font-weight:bold;
            color:#d0d0d0;
            letter-spacing:2px;
            font-size:13px;
        }

        .item .description {
            font-size:15px;
            margin-top:15px;
            margin-bottom:20px;
        }

        .item img {
            max-width:160px;
    }
    </style>
@endpush
@section('content')
    @php
        /** @var \App\Models\Kinsman $model */
        /** @var \App\Models\Kinsman[] $children */
     @endphp

    <a href="{{ route('platform.kinsman.edit', $model->id) }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
        </svg>
    </a>
{{--    <button class="btn btn-danger js-delete"--}}
{{--            data-ref="{{ route('kinsmans.destroy', $model->id) }}"--}}
{{--            data-csrf="{{ csrf_token() }}"--}}
{{--            data-redirect="{{ route('kinsmans.index') }}"--}}
{{--    >--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">--}}
{{--            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>--}}
{{--        </svg>--}}
{{--    </button>--}}
    <a href="{{ route('kinsmans.index') }}" class="btn btn-success">Список</a>

    <main role="main" class="container">

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <h2>{{ $model->name }} {{ $model->middle_name }} {{ $model->kin->name ?? '' }}</h2>
                </div>
                {{--<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <img src="img.url">
                </div>--}}
            </div>
        </div>
        @if(!empty($model->life->id))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('Kinsman.Label.Bio') }}</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @if(!empty($model->life->birth_date))
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                        <p>{{ Carbon\Carbon::make($model->life->birth_date)->format('j F Y') }} - Дата рождения</p>
{{--                        <p>{{ Carbon\Carbon::make($model->life->birth_date)->format('H:i') }} - Время рождения</p>--}}
                    </div>
                    @endif

                    @if(!empty($model->life->end_date))
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <p>{{ Carbon\Carbon::make($model->life->end_date)->format('j F Y') }} - Дата смерти</p>
                    </div>
                    @endif

                    @if($model->nativeCity->first() && !empty($model->nativeCity->first()->name))
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <p>{{ $model->nativeCity->first()->name }} - Город рождения</p>
                        </div>
                    @endif
                </div>
            </div>
        <hr>
        @endif

        @if(isset($model->father->id) || isset($model->mother->id))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('Kinsman.Label.Parents') }}</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row people">
                    @isset($model->father->id)
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $model->father->id) }}">
                                <img class="rounded-circle" src="{{ $model->father->getImage() }}" alt="{{ $model->father->name }}">
                            </a>
                            <a href="{{ route('kinsmans.show', $model->father->id) }}">
                                <h3 class="name">{{ $model->father->getFullNameAttribute() }}</h3>
                            </a>
                            @if(!empty($model->father->life->birth_date))
                                <p class="title">{{ Carbon\Carbon::make($model->father->life->birth_date)->format('j F Y') }}</p>
                            @endif
                            @if(!empty($model->father->kin->name))
                                <p class="description">{{ $model->father->kin->name }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                    @isset($model->mother->id)
                        <div class="col-md-6 col-lg-4 item">
                            <div class="box">
                                <a href="{{ route('kinsmans.show', $model->mother->id) }}">
                                    <img class="rounded-circle" src="{{ $model->mother->getImage() }}" alt="{{ $model->mother->name }}">
                                </a>
                                <a href="{{ route('kinsmans.show', $model->mother->id) }}">
                                    <h3 class="name">{{ $model->mother->getFullNameAttribute() }}</h3>
                                </a>
                                @if(!empty($model->mother->life->birth_date))
                                    <p class="title">{{ Carbon\Carbon::make($model->mother->life->birth_date)->format('j F Y') }}</p>
                                @endif
                                @if(!empty($model->mother->kin->name))
                                    <p class="description">{{ $model->mother->kin->name }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        <hr>
        @endif

        @if(!empty($model->gender === 'male' ? $model->wife : $model->husband))
            <div class="container">
                @if(isset($model->wife->first()->id) && !empty($model->wife->first()->id))
                    <h2>{{ __('Kinsman.Label.Wife') }}</h2>
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $model->wife->first()->id) }}">
                                <img class="rounded-circle" src="{{ $model->wife->first()->getImage() }}" alt="{{ $model->wife->first()->name }}">
                            </a>
                            <a href="{{ route('kinsmans.show', $model->wife->first()->id) }}">
                                <h3 class="name">{{ $model->wife->first()->getFullNameAttribute() }}</h3>
                            </a>
                            @if(!empty($model->wife->first()->life->birth_date))
                                <p class="title">{{ Carbon\Carbon::make($model->wife->first()->life->birth_date)->format('j F Y') }}</p>
                            @endif
                            @if(!empty($model->wife->first()->kin->name))
                                <p class="description">{{ $model->wife->first()->kin->name }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            @if(isset($model->husband->first()->id) && !empty($model->husband->first()->id))
                <h2>{{ __('Kinsman.Label.Husband') }}</h2>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box">
                        <a href="{{ route('kinsmans.show', $model->husband->first()->id) }}">
                            <img class="rounded-circle" src="{{ $model->husband->first()->getImage() }}" alt="{{ $model->husband->first()->name }}">
                        </a>
                        <a href="{{ route('kinsmans.show', $model->husband->first()->id) }}">
                            <h3 class="name">{{ $model->husband->first()->getFullNameAttribute() }}</h3>
                        </a>
                        @if(!empty($model->husband->first()->life->birth_date))
                            <p class="title">{{ Carbon\Carbon::make($model->husband->first()->life->birth_date)->format('j F Y') }}</p>
                        @endif
                        @if(!empty($model->husband->first()->kin->name))
                            <p class="description">{{ $model->husband->first()->kin->name }}</p>
                        @endif
                    </div>
                </div>
            @endif
        @endif

        @if($children->count())
            <div class="container">
                <h2 class="child-box">{{ __('Kinsman.Children.List') }}</h2>
                <div class="row people">
                @foreach($children as $child)
                    @php /** @var \App\Models\Kinsman $child */ @endphp
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $child->id) }}">
                                <img class="rounded-circle" src="{{ $child->getImage() }}" alt="{{ $child->name }}">
                            </a>
                            <a href="{{ route('kinsmans.show', $child->id) }}">
                                <h3 class="name">{{ $child->getFullNameAttribute() }}</h3>
                            </a>
                            @if(!empty($child->life->birth_date))
                                <p class="title">{{ Carbon\Carbon::make($child->life->birth_date)->format('j F Y') }}</p>
                            @endif
                            @if(!empty($child->kin->name))
                                <p class="description">{{ $child->kin->name }}</p>
                            @endif
                            @if(isset($child->mother->id) && $child->mother->id !== $model->id)
                                <h4>{{ __('Kinsman.Label.Mother') }}</h4>
                                <a href="{{ route('kinsmans.show', $child->mother->id) }}">
                                    <span>{{ $child->mother->getFullNameAttribute() }}</span>
                                </a>
                            @endif
                            @if(isset($child->father->id) && $child->father->id !== $model->id)
                                <h4>{{ __('Kinsman.Label.Father') }}</h4>
                                <a href="{{ route('kinsmans.show', $child->father->id) }}">
                                    <span>{{ $child->father->getFullNameAttribute() }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        @endif
    </main>
@endsection
