@extends('layouts.app')

@section('content')
    <h1>Salut {{ auth()->user()->name }}</h1>
    @foreach (auth()->user()->likes  as $like)
        {{ $like->title }}
    @endforeach
@endsection
