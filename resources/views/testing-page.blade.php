@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="test">

        <div class="test-content">
            <form action="{{ route('Test.cookie') }}" class="test-content__form form-inline js-send-form">

                @csrf

                <div class="form-group mx-sm-4 mb-1">
                    <input type="text"
                           class="form-control"
                           name="numberHourly"
                           placeholder="{{ __('test.cookieHourlyPlaceHolder') }}"
                    />
                </div>

                <div class="form-group mx-sm-4 mb-1">
                    <input type="text"
                           class="form-control"
                           name="numberForever"
                           placeholder="{{ __('test.cookieForeverPlaceHolder') }}"
                    />
                </div>

                <button class="btn btn-success mb-2">Send</button>

            </form>

            <div class="row">
                @foreach($cookies as $class => $cookie)

                <div
                    class="alert alert-success {{ $class }} col-5 mr-5 test-content__cookie"
                >Cookie set {{ $class === "cookie_hourly" ? "by 1 hour" : "forever" }} is "{{ $cookie }}"</div>

                @endforeach
            </div>

        </div>
        <br>
        <hr>
        <div class="form-wrap">
            <form action="{{ route('Test.word') }}" class="row g-3">

                @csrf

                <div class="col-md-12">
                    <label for="word-split" class="form-label">Enter a word and it will split</label>
                    <input type="text"
                           class="form-control @error('word-split'){{ "border-danger" }}@enderror"
                           id="word-split"
                           name="word-split"
                    />
                </div>
                @error('word-split')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <div class="ml-5">
                    <button type="button" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('aside')
{{--    @parent--}}
@endsection
