@extends('layout')

@section('content')
    <h1>Create New Book</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label>Author:</label>
            <input type="text" name="author" value="{{ old('author') }}">
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection
