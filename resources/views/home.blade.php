@extends('layouts.app')
@section('title'){{ $title }}@endsection
@section('content')

<div class="home-content">
    <div class="form-wrap">
        <form action="{{ route('Create') }}" method="post" class="row g-3 needs-validation" novalidate>

            @csrf

            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text"
                           class="form-control @error('username'){{ "border-danger" }}@enderror"
                           id="validationCustomUsername"
                           aria-describedby="inputGroupPrepend"
                           name="username"
                    >
                </div>
                @error('username')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           class="form-control @error('name'){{ "border-danger" }}@enderror"
                           name="name"
                           placeholder="input name"
                           id="name"
                    >
                </div>
                @error('name')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text"
                           class="form-control @error('email'){{ "border-danger" }}@enderror"
                           name="email"
                           placeholder="input email"
                           id="email"
                    >
                </div>
                @error('email')
                    <div class="alert alert-danger">
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @enderror
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="subject">subject</label>
                    <input type="text"
                           name="subject"
                           class="form-control @error('subject'){{ "border-danger" }}@enderror"
                           placeholder="input subject"
                           id="subject"
                    >
                </div>
                @error('subject')
                    <div class="alert alert-danger">
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @enderror
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control @error('message'){{ "border-danger" }}@enderror"
                              name="message"
                              placeholder="Edit it"
                              id="message"
                    ></textarea>
                </div>
                @error('message')
                <div class="alert alert-danger">
                    <div class="">
                        <span>{{ $message }}</span>
                    </div>
                </div>
                @enderror
            </div>

            <div class="ml-5">
                <button type="submit" class="btn btn-success">Send</button>
            </div>

        </form>
    </div>
</div>

@endsection

@section('aside')
    @parent
        <div class="container">
            @foreach($contacts as $contact)
                <span>{{ $contact->name }}</span>
                <span>{{ $contact->username }}</span>
                <span>{{ $contact->email }}</span>
            @endforeach
        </div>
@endsection
