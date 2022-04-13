@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('Test.Note.Create') }}"
       class="btn btn-success"
    >{{ __('Note.Create') }}</a>

    @foreach($notes as $note)
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
@endsection
