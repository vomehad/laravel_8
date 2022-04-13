@extends('layouts.app')
@section('title', $title)
@section('content')
    <h1>{{ Lang::get('account.hello') }} {{ $title }}</h1>
@endsection
