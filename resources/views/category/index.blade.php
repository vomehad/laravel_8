@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="control">
        <a href="{{ route('test.categories.create') }}"
           class="btn btn-success"
        >{{ __('Category.Button.Create') }}</a>
    </div>
    <div class="content">
        @foreach($models as $category)
            <div class="btn btn-default">{{ $category->name }}</div>
        @endforeach
    </div>
@endsection
