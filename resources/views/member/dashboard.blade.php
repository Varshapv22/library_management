@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1 class="display-4">Member Dashboard</h1>
            <p class="lead">Welcome, {{ Auth::user()->name }}! Here’s an overview of your library account.</p>
        </div>
    </div>

    <div class="row">
        <!-- Card: Available Books -->
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Available Books</div>
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ $availableBooksCount }}</h5> --}}
                    <p class="card-text">Explore our collection of books available for borrowing.</p>
                    <a href="{{ route('member.books') }}" class="btn btn-light">View Books</a>
                </div>
            </div>
        </div>

        <!-- Card: Borrowed Books -->
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Borrowed Books</div>
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ $borrowedBooksCount }}</h5> --}}
                    <p class="card-text">Check your currently borrowed books and due dates.</p>
                    <a href="{{ route('member.books.borrowed') }}" class="btn btn-light">View Borrowed Books</a>
                </div>
            </div>
        </div>




</div>
@endsection
