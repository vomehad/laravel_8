@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('test.notes.edit', ['note' => $note->id]) }}"
       class="btn btn-primary"
    >{{ __('Note.Button.Update') }}</a>

    <button class="btn btn-danger js-delete"
            data-ref="{{ route('test.notes.destroy', ['note' => $note->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('test.notes.index') }}"
    >{{ __('Note.Button.Delete') }}</button>

    <main role="main" class="container">

        <div class="starter-template">
            <p class="lead">{{ $note->content }}</p>
        </div>

    </main>
@endsection
