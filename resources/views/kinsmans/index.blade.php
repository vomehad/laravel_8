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
        <table>
            <thead>
            <tr>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.Name') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.MiddleName') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.Gender') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.Father') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.Mother') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kinsman.Table.Kin') }}</div></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
        @foreach($models as $user)
            @php /** @var \App\Models\Kinsman $user */ @endphp

            <tr>
                <td><div class="btn btn-default">{{ $user->name }}</div></td>
                <td><div class="btn btn-default">{{ $user->middle_name }}</div></td>
                <td><div class="btn btn-default">{{ $user->gender }}</div></td>

                @isset($user->father->id)
                <td><a href="{{ route('kinsmans.show', $user->father->id) }}" class="btn btn-default">{{ $user->father->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $user->father->name ?? '-' }}</div></td>
                @endif

                @isset($user->mother->id)
                <td><a href="{{ route('kinsmans.show', $user->mother->id) }}" class="btn btn-default">{{ $user->mother->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $user->mother->name ?? '-' }}</div></td>
                @endif

                @isset($user->kin->id)
                <td><a href="{{ route('kins.show', $user->kin->id) }}" class="btn btn-default">{{ $user->kin->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $user->kin->name ?? '-' }}</div></td>
                @endif

                <td><a href="{{ route('kinsmans.show', $user->id) }}" class="btn btn-success">{{ __('Kinsman.Button.View') }}</a></td>
                <td><a href="{{ route('kinsmans.edit', $user->id) }}" class="btn btn-primary">{{ __('Kinsman.Button.Update') }}</a></td>
                <td><a href="{{ route('kinsmans.destroy', $user->id) }}" class="btn btn-danger">{{ __('Kinsman.Button.Delete') }}</a></td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@endsection
