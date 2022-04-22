@extends('layouts.app')
@section('title', $title)
@section('content')
{{--    <div class="control">--}}
{{--        <a href="{{ route('User.New') }}" class="btn btn-success">{{ __('User.Button.Create') }}</a>--}}
{{--    </div>--}}
    <div class="content">
        @foreach($models as $user)
            <div class="btn btn-default">{{ $user->username }}</div>
            <div class="btn btn-default">{{ $user->email }}</div>
            <a href="{{ route('User.Update', ['id' => $user->id]) }}" class="btn btn-primary">{{ __('User.Button.Update') }}</a>
            <a href="{{ route('User.Delete', ['id' => $user->id]) }}" class="btn btn-danger">{{ __('User.Button.Delete') }}</a>
            <a href="{{ route('User.Roles', ['id' => $user->id]) }}" class="btn btn-success">{{ __('User.Button.Roles') }}</a>
            <hr>
        @endforeach
    </div>
@endsection
