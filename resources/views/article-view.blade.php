@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('Article.Update', ['id' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('Article.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('Article.Delete', ['id' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route("Article.Main") }}"
    >{{ __('Article.Button.Delete') }}</button>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>{{ $model->title }}</h1>
            <div>{!! $model->text !!}</div>
        </div>

    </main>
@endsection
