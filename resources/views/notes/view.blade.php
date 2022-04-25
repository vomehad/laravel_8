@extends('layouts.app')
@section('title', $title)
@section('content')
    @php /* @var \App\Models\Note $note @endphp
    <a href="{{ route('test.notes.edit', ['note' => $note->id]) }}"
       class="btn btn-primary"
    >{{ __('Note.Button.Update') }}</a>

    <button class="btn btn-danger js-delete"
            data-ref="{{ route('test.notes.destroy', ['note' => $note->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('test.notes.index') }}"
    >{{ __('Note.Button.Delete') }}</button>

    <main role="main" class="container">
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="starter-template">
            <p class="lead">{{ old('content', $note->content) }}</p>
        </div>

    </main>
@endsection
