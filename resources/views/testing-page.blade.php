@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="test">

        <div class="test-content">
            <form action="{{ route('Test.cookie') }}" class="test-content__form form-inline js-send-form">

                @csrf

                <div class="form-group mx-sm-3 mb-2">
                    <label for="int" class="sr-only">Enter number for Site</label>
                    <input type="text"
                           class="form-control"
                           id="int"
                           name="number"
                           placeholder="Enter number for Site"
                    />
                </div>

                <button class="btn btn-success mb-2">Send</button>

            </form>

            <div class="alert alert-success php">Cookie {{ $cookie }}</div>

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
