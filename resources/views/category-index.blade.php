@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="content">
        @foreach($models as $category)
            {{ $category->name }}
        @endforeach
    </div>
@endsection
