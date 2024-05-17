@extends('layout')

@section('content')
    <h1>Edit Book</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ $book->title }}">
        </div>
        <div>
            <label>Author:</label>
            <input type="text" name="author" value="{{ $book->author }}">
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description">{{ $book->description }}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection
