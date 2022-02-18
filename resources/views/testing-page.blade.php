@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="test">

        <div class="test-content">
            <form action="{{ route('Test.cookie') }}" class="test-content__form form-inline js-send-form" id="cookie-form">

                @csrf

                <div class="form-group mx-sm-4 mb-1">
                    <input type="text"
                           class="form-control"
                           name="numberHourly"
                           placeholder="{{ __('test.cookie.placeholder.hourly') }}"
                    />
                </div>

                <div class="form-group mx-sm-4 mb-1">
                    <input type="text"
                           class="form-control"
                           name="numberForever"
                           placeholder="{{ __('test.cookie.placeholder.forever') }}"
                    />
                </div>

                <button class="btn btn-success mb-2">Send</button>

            </form>

            <div class="row js-cookies">
                @foreach($cookies as $class => $cookie)

                <div
                    class="alert alert-success {{ $class }} col-5 mr-5 test-content__cookie"
                >Cookie set {{ $class === "cookie_hourly" ? "by 1 hour" : "forever" }} is "{{ $cookie }}"</div>

                @endforeach
            </div>

        </div>
        <hr>
        <div class="test-content">
            <form action="{{ route('Test.word') }}" class="test-content__form js-send-form row" id="split-form">

                @csrf

                <div class="form-group col-10">
                    <input type="text"
                           class="form-control"
                           name="wordSplit"
                           placeholder="{{ __('test.word.placeholder') }}"
                    />
                    <div class="alert alert-success test-content__split mt-lg-2"></div>


                </div>

                <button class="btn btn-success col-2">{{ __('test.word.button') }}</button>

            </form>

            @isset($splitWord)
            <div class="row">
                    <div
                        class="alert alert-success test-content__word col-5 mr-5"
                    >Cookie set {{ $class === "cookie_hourly" ? "by 1 hour" : "forever" }} is "{{ $splitWord }}"</div>
            </div>
            @endisset
        </div>
        <hr>
        <div class="test-content">
            <form action="{{ route('Test.word') }}" class="test-content__form js-send-form" id="text-form">

                @csrf

                <div class="row">
                    <div class="form-group col-10">
                        <input type="text"
                               class="form-control"
                               name="wordSplit"
                               placeholder="{{ __('test.word.placeholder') }}"
                        />
                        @isset($splitWord)
                            <div class="row">
                                <div
                                    class="alert alert-success test-content__word col-5 mr-5"
                                >Cookie set {{ $class === "cookie_hourly" ? "by 1 hour" : "forever" }} is "{{ $splitWord }}"</div>
                            </div>
                        @endisset

                    </div>

                    <button type="button" class="btn btn-success col-2">{{ __('test.word.button') }}</button>
                </div>

            </form>

            @isset($splitWord)
                <div class="row">
                    <div
                        class="alert alert-success test-content__word col-5 mr-5"
                    >Cookie set {{ $class === "cookie_hourly" ? "by 1 hour" : "forever" }} is "{{ $splitWord }}"</div>
                </div>
            @endisset
        </div>

    </div>
@endsection

@section('aside')
{{--    @parent--}}
@endsection
