@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="note-content">
        <div class="form-wrap">
            <form action="{{ route('Test.Note.Store') }}" method="post" class="row">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text"
                           class="form-control @error('name'){{ "border-danger" }}@enderror"
                           name="name"
                           placeholder="input Name"
                           id="name"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content'){{ "border-danger" }}@enderror"
                              name="content"
                              placeholder="Edit it"
                              id="content"
                              cols="30"
                              rows="10"
                    ></textarea>
                </div>
                @error('content')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
