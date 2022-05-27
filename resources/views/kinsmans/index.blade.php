@extends('layouts.app')
@section('content')
    <form class="input" action="{{ route('kinsmans.search') }}" method="post">
        @csrf
        <div class="form-outline">
            <input type="search" name="search"
                   id="search-input"
                   class="form-control"
                   value="{{ $string ?? '' }}"
            />
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Kinsman.Button.Search') }}</button>
    </form>

    <div class="control">
        <a href="{{ route('kinsmans.create') }}"
           class="btn btn-success"
        >{{ __('Kinsman.Button.Create') }}</a>
    </div>

    <div class="content">
        @foreach($models as $user)
            @php /** @var \App\Models\Kinsman $user */ @endphp
            <div class="btn btn-default">{{ $user->username }}</div>
            <div class="btn btn-default">{{ $user->email }}</div>
            <a href="{{ route('kinsmans.edit', $user->id) }}" class="btn btn-primary">{{ __('Kinsman.Button.Update') }}</a>
            <a href="{{ route('kinsmans.destroy', $user->id) }}" class="btn btn-danger">{{ __('Kinsman.Button.Delete') }}</a>
            <a href="{{ route('kinsmans.roles', $user->id) }}" class="btn btn-success">{{ __('Kinsman.Button.Roles') }}</a>
            <hr>
        @endforeach
    </div>
@endsection
