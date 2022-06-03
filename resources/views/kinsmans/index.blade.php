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
        @foreach($models as $kinsman)
            @php /** @var \App\Models\Kinsman $kinsman */ @endphp

            <tr>
                <td><div class="btn btn-default">{{ $kinsman->name }}</div></td>
                <td><div class="btn btn-default">{{ $kinsman->middle_name }}</div></td>
                <td><div class="btn btn-default">{{ $kinsman->getGender($kinsman->gender) }}</div></td>

                @isset($kinsman->father->id)
                <td><a href="{{ route('kinsmans.show', $kinsman->father->id) }}" class="btn btn-default">{{ $kinsman->father->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $kinsman->father->name ?? '-' }}</div></td>
                @endif

                @isset($kinsman->mother->id)
                <td><a href="{{ route('kinsmans.show', $kinsman->mother->id) }}" class="btn btn-default">{{ $kinsman->mother->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $kinsman->mother->name ?? '-' }}</div></td>
                @endif

                @isset($kinsman->kin->id)
                <td><a href="{{ route('kins.show', $kinsman->kin->id) }}" class="btn btn-default">{{ $kinsman->kin->name ?? '-' }}</a></td>
                @else
                <td><div class="btn btn-default">{{ $kinsman->kin->name ?? '-' }}</div></td>
                @endif

                <td><a href="{{ route('kinsmans.show', $kinsman->id) }}" class="btn btn-success">{{ __('Kinsman.Button.View') }}</a></td>
                <td><a href="{{ route('kinsmans.edit', $kinsman->id) }}" class="btn btn-primary">{{ __('Kinsman.Button.Update') }}</a></td>
                <td><a href="{{ route('kinsmans.destroy', $kinsman->id) }}" class="btn btn-danger">{{ __('Kinsman.Button.Delete') }}</a></td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@endsection
