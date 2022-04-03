@extends('layouts.app')
@section('title', $title)
@section('content')
{{ dump($notes) }}
<a href="{{ route('Test.Notes.Create') }}"></a>
@endsection
