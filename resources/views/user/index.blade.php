@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="content">
        @foreach($models as $user)
            <div class="btn btn-default">{{ $user->username }}</div>
            <div class="btn btn-default">{{ $user->email }}</div>
            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">{{ __('User.Button.Update') }}</a>
            <a href="{{ route('users.destroy', ['user' => $user->id]) }}" class="btn btn-danger">{{ __('User.Button.Delete') }}</a>
            <a href="{{ route('users.roles', ['id' => $user->id]) }}" class="btn btn-success">{{ __('User.Button.Roles') }}</a>
            <hr>
        @endforeach
    </div>
@endsection
