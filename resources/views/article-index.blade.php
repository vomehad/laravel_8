@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="input">
        <div class="form-outline">
            <input type="search" id="search-input" class="form-control" />
        </div>
        <button type="button" class="btn btn-primary">{{ __('Article.Button.Search') }}</button>
    </div>

    <div class="control">
        <a href="{{route('Article.New')}}" class="btn btn-success">{{__('Article.Button.Create')}}</a>
    </div>

    <div class="content">
    @foreach($articles as $article)
        <div class="list-group">
            <a href="{{ route('Test.Note.View', ['id' => $article->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $note->title }}</h5>
                    <small>{{ $note->updated_at }}</small>
                </div>
                <p class="mb-1">{{ $note->text }}</p>
                <small>mi</small>
            </a>
        </div>
    @endforeach
    </div>

@endsection
