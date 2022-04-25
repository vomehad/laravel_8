@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('test.categories.edit', ['category' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('Category.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('test.categories.destroy', ['category' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('test.categories.index') }}"
    >{{ __('Category.Button.Delete') }}</button>

    <main role="main" class="container">
        <div class="starter-template">
            <p class="lead">{{ $model->content }}</p>
        </div>
    </main>
@endsection
