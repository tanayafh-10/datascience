@extends('layout')

@section('content')
    <h1>{{ $book->title }}</h1>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>
    <a href="{{ route('books.index') }}">Back to List</a>
@endsection
