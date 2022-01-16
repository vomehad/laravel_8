@extends('layouts.app')

    @section('title')"{{$title}}"@endsection

    @section('content')
        <h1>Welcome to home</h1>
    @endsection

    @section('aside')
        @parent
            <p>adding text</p>
    @endsection
