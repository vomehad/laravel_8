@extends('layouts.app')

    @section('title')"{{ $title }}"@endsection

    @section('content')
        <div class="test-content">
            <div class="form-wrap">
                <form action="{{ route('Test.word') }}" class="row g-3"></form>
            </div>
        </div>
    @endsection

    @section('aside')
{{--        @parent--}}
    @endsection
