<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of available books with search and filter options.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('author', 'like', "%{$searchTerm}%")
                ->orWhere('ISBN', 'like', "%{$searchTerm}%");
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'available'); // Default to available books
        }

        $books = $query->get();

        return view('books.index', compact('books'));
    }

    /**
     * Borrow a book.
     */
    public function borrow(Book $book)
    {
        if ($book->status === 'available') {
            $book->update([
                'status' => 'borrowed',
                'borrowed_date' => now(),
                'due_date' => now()->addDays(7),
            ]);

            return back()->with('success', 'Book borrowed successfully.');
        }

        return back()->with('error', 'This book is not available for borrowing.');
    }

    /**
     * Return a borrowed book.
     */
    public function return(Book $book)
    {
        if ($book->status === 'borrowed') {
            $book->update([
                'status' => 'available',
                'borrowed_date' => null,
                'due_date' => null,
            ]);

            return back()->with('success', 'Book returned successfully.');
        }

        return back()->with('error', 'This book is not currently borrowed.');
    }

    /**
     * List all books for members with filtering and searching.
     */
    public function listBooks(Request $request)
    {
        $query = Book::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('author', 'like', "%{$searchTerm}%")
                ->orWhere('ISBN', 'like', "%{$searchTerm}%");
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $books = $query->get();

        return view('member.books.list', compact('books'));
    }

    /**
     * Borrow a book by ID.
     */
    public function borrowBook($id)
    {
        $book = Book::findOrFail($id);

        if ($book->status !== 'available') {
            return back()->with('error', 'This book is not available for borrowing.');
        }

        $book->update([
            'status' => 'borrowed',
            'borrowed_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        return back()->with('success', 'Book borrowed successfully. Please return it by ' . $book->due_date->format('d M Y') . '.');
    }

    /**
     * Return a borrowed book by ID.
     */
    public function returnBook($id)
    {
        $book = Book::findOrFail($id);

        if ($book->status !== 'borrowed') {
            return back()->with('error', 'This book is not currently borrowed.');
        }

        $book->update([
            'status' => 'available',
            'borrowed_date' => null,
            'due_date' => null,
        ]);

        return back()->with('success', 'Book returned successfully.');
    }

    /**
     * Display a list of borrowed books.
     */
    public function borrowedBooks()
    {
        $books = Book::where('status', 'borrowed')->get();
        return view('member.books.borrowed', compact('books'));
    }
    
}
