@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="control">
        <a href="{{ route('tags.create') }}" class="btn btn-success">{{ __('Tag.Button.Create') }}</a>
    </div>
    <div class="content">
        @foreach($models as $tag)
            <div class="btn btn-default">{{ $tag->name }}</div>
        @endforeach
    </div>
@endsection
