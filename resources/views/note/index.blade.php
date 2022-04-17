@extends('layouts.app')
@section('title', $title)
@section('content')
    <form class="input" action="{{ route('Test.Note.Search') }}" method="post">
        @csrf
        <div class="form-outline">
            <input type="search" name="search" id="search-input" class="form-control" value="{{ $string ?? '' }}" />
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Note.Button.Search') }}</button>
    </form>

    <div class="control">
        <a href="{{ route('Test.Note.Create') }}" class="btn btn-success">{{ __('Note.Button.Create') }}</a>
    </div>

    <div class="content">
        <span>{{ __('Test.Note.Search-result') }} - {{ $models->total() }}</span>
    @foreach($models as $note)
        <div class="list-group">
            <a href="{{ route('Test.Note.View', ['id' => $note->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $note->name }}</h5>
                    <small>{{ $note->updated_at }}</small>
                </div>
                <p class="mb-1">{{ $note->content }}</p>
                <small>mi</small>
            </a>
        </div>
    @endforeach
    </div>

    {{ $models->onEachSide(5)->links() }}
@endsection
