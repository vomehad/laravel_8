@extends('layouts.app')
@section('title', $title)
@section('content')
    <form action="{{ route('Login') }}" class="col-6 offset-2 border rounded" method="POST">

        @csrf

        <div class="form-group">
            <label for="email" class="col-form-label-lg">Email</label>
            <input type="email"
                   class="form-control @error('email') border-danger @enderror"
                   id="email"
                   value=""
                   placeholder="Email"
            />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label-lg">Password</label>
            <input type="password"
                   class="form-control @error('password') border-danger @enderror"
                   id="password"
                   value=""
                   placeholder="Password"
            />
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary"
                    type="submit"
                    name="sendMe"
                    value="1"
            >Login</button>
        </div>

    </form>
@endsection
