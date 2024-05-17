@extends('layout')

@section('content')
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Create New Book</a>
    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->description }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}">Show</a>
                    <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
