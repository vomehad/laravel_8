@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('articles.edit', ['article' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('Article.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('articles.destroy', ['article' => $model->id]) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route("articles.index") }}"
    >{{ __('Article.Button.Delete') }}</button>

    <main role="main" class="container">

        <div class="starter-template">
            <span class="link"><a href="{{ $model->link }}">{{ $model->link }}</a></span>
            <div>{!! $model->text !!}</div>
            @foreach($model->category as $category)
            <div class="">{{ $category->name }}</div>
            @endforeach
        </div>

    </main>
@endsection