@extends('layouts.app')

    @section('title')"{{ $title }}"@endsection

    @section('content')
        <h1>Test Regex</h1>
        <div class="">{{ $regex }}</div>
    @endsection

    @section('aside')
        @parent
        <p>adding text</p>
    @endsection
