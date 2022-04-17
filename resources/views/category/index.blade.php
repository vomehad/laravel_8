@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="control">
        <a href="{{ route('Test.Category.New') }}"
           class="btn btn-success"
        >{{ __('Category.Button.Create') }}</a>
    </div>
    <div class="content">
        @foreach($models as $category)
            {{ $category->name }}
        @endforeach
    </div>
@endsection
