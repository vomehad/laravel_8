@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="form-wrap">
        <form action="{{ route('Article.Store') }}" method="post" class="row">
            @csrf

            <div class="col-md-12">
                <label for="title" class="form-label">{{ __('Article.Label.Title') }}</label>
                <input type="text"
                       class="form-control @error('title') border-danger @enderror"
                       name="title"
                       placeholder="{{ __('Article.Placeholder.Title') }}"
                       id="title"
                       value="{{ $model->title }}"
                >
            </div>
            @error('title')
            <div class="alert alert-danger">
                <span>{{ $message }}</span>
            </div>
            @enderror

            <div class="col-md-12">
                <label for="text" class="form-label">{{ __('Article.Label.Text') }}</label>
                <textarea class="form-control @error('text') border-danger @enderror"
                          name="text"
                          placeholder="{{ __('Article.Placeholder.Text') }}"
                          id="text"
                          rows="16"
                >{{ $model->text }}</textarea>
            </div>
            @error('text')
            <div class="alert alert-danger">
                <span>{{ $message }}</span>
            </div>
            @enderror

            <div class="ml-5">
                <button type="submit" class="btn btn-success">{{ __('Article.Button.Save') }}</button>
            </div>
        </form>
    </div>
@endsection
