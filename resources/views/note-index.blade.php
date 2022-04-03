@extends('layouts.app')
@section('title', $title)
@section('content')
    {{ dump($notes) }}
    <a href="{{ route('Test.Note.Create') }}" class="btn btn-success">Create Note</a>
@endsection
