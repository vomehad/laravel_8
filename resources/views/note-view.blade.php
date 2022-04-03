@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="">{{ $note->name }}</div>
    <div class="">{{ $note->content }}</div>
@endsection
