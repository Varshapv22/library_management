@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Books</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('member.books') }}">
        <div class="mb-3 row">
            <!-- Search Input -->
            <div class="col-md-6">
                <input type="text" name="search" class="form-control"
                       placeholder="Search by title, author, or ISBN"
                       value="{{ request('search') }}">
            </div>

            <!-- Status Filter -->
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Books Table -->
    @if($books->isEmpty())
        <div class="alert alert-warning">No books found matching your criteria.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Status</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->ISBN }}</td>
                    <td>
                        <span class="badge bg-{{ $book->status === 'available' ? 'success' : 'warning' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </td>
                    <td>{{ $book->borrowed_date ? $book->borrowed_date->format('d M Y') : '-' }}</td>
                    <td>
                        @if($book->due_date)
                            @if($book->due_date < now())
                                <span class="text-danger">
                                    {{ $book->due_date->format('d M Y') }} (Overdue)
                                </span>
                            @else
                                {{ $book->due_date->format('d M Y') }}
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($book->status === 'available')
                            <form action="{{ route('member.books.borrow', $book->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Borrow</button>
                            </form>
                        @elseif($book->status === 'borrowed')
                            <form action="{{ route('member.books.return', $book->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Return</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div> --}}
    @endif
</div>
@endsection
