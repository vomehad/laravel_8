@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Kinsman $model */ @endphp
    @php /** @var \App\Models\Kinsman[] $children */ @endphp

    <a href="{{ route('kinsmans.edit', $model->id) }}"
       class="btn btn-primary"
    >{{ __('Kinsman.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('kinsmans.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('kinsmans.index') }}"
    >{{ __('Kinsman.Button.Delete') }}</button>

    <main role="main" class="container">
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
                <tr>
                    <td><div class="starter-template">{{ $model->name }}</div></td>
                    <td><div class="starter-template">{{ $model->middle_name }}</div></td>
                    <td><div class="starter-template">{{ $model->gender }}</div></td>
                    <td><div class="starter-template">{{ $model->father->name ?? '-'}}</div></td>
                    <td><div class="starter-template">{{ $model->mother->name ?? '-' }}</div></td>
                    <td><div class="starter-template">{{ $model->kin->name ?? '-' }}</div></td>
                </tr>
            </tbody>
        </table>
        <hr>

        @if($children->count())
        <div class="">{{ __('Kinsman.Children.List') }}</div>
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
            @foreach($children as $child)
            <tr>
                <td><div class="starter-template">{{ $child->name }}</div></td>
                <td><div class="starter-template">{{ $child->middle_name }}</div></td>
                <td><div class="starter-template">{{ $child->gender }}</div></td>

                @if(isset($child->father->id) && $child->father->id !== $model->id)
                    <td><a href="{{ route('kinsmans.show', $child->father->id) }}">{{ $child->father->name }}</a></td>
                @else
                    <td><div class="starter-template">{{ $child->father->name ?? '-'}}</div></td>
                @endif

                @if(isset($child->mother->id) && $child->mother->id !== $model->id)
                    <td><a href="{{ route('kinsmans.show', $child->mother->id) }}">{{ $child->mother->name }}</a></td>
                @else
                    <td><div class="starter-template">{{ $child->mother->name ?? '-' }}</div></td>
                @endif

                @isset($child->kin->id)
                    <td><a href="{{ route('kins.show', $child->kin->id) }}">{{ $child->kin->name }}</a></td>
                @else
                    <td><div class="starter-template">{{ $child->kin->name ?? '-' }}</div></td>
                @endif

                <td><a href="{{ route('kinsmans.show', $child->id) }}" class="btn btn-success">{{ __('Kinsman.Button.View') }}</a></td>
                <td><a href="{{ route('kinsmans.edit', $child->id) }}" class="btn btn-primary">{{ __('Kinsman.Button.Update') }}</a></td>
                <td><a href="{{ route('kinsmans.destroy', $child->id) }}" class="btn btn-danger">{{ __('Kinsman.Button.Delete') }}</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </main>
@endsection
