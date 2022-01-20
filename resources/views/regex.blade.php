@extends('layouts.app')

    @section('title')"{{ $title }}"@endsection

    @section('content')
        <div class="">{{ $regex }}</div>
    @endsection

    @section('aside')
{{--        @parent--}}
    @endsection
