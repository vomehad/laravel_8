@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('Article.Update', ['id' => $model->id]) }}"
       class="btn btn-primary"
    >{{ __('Article.Button.Update') }}</a>
    <a href="{{ route('Article.Delete', ['id' => $model->id]) }}"
       class="btn btn-danger js-delete"
    >{{ __('Article.Button.Delete') }}</a>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>{{ $model->title }}</h1>
            <div>{!! $model->text !!}</div>
        </div>

    </main>
@endsection
