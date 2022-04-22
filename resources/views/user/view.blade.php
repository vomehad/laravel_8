@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('User.Update', ['id' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('User.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('User.Delete', ['id' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('User.List') }}"
    >{{ __('User.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="starter-template">
            <p class="lead">{{ $model->content }}</p>
        </div>
    </main>
@endsection
