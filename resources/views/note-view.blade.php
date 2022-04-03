@extends('layouts.app')
@section('title', $title)
@section('content')
    <a href="{{ route('Test.Note.Update') }}"
       class="btn btn-primary"
    >Update Note</a>
    <a href="{{ route('Test.Note.Delete', ['id' => $note->id]) }}"
       class="btn btn-success"
    >Delete Note</a>

    <div class="">{{ $note->name }}</div>
    <div class="">{{ $note->content }}</div>
@endsection
