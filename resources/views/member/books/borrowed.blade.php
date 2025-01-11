@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Borrowed Books</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->borrowed_date }}</td>
                    <td>{{ $book->due_date }}</td>
                    <td>
                        <form action="{{ route('member.books.return', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Return</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No borrowed books.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
