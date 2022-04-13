@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('Test.Note.Update', ['id' => $note->id]) }}"
       class="btn btn-primary"
    >{{ __('Note.Button.Update') }}</a>
{{--    <a href="{{ route('Test.Note.Delete', ['id' => $note->id]) }}"--}}
{{--       class="btn btn-danger js-delete"--}}
{{--    >{{ __('Note.Button.Delete') }}</a>--}}
    <button class="btn btn-danger js-delete">{{ __('Note.Button.Delete') }}</button>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>{{ $note->name }}</h1>
            <p class="lead">{{ $note->content }}</p>
        </div>

    </main>
@endsection
