<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
require __DIR__.'/auth.php';

// Role-based routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/upload-books', [AdminController::class, 'showUploadForm'])->name('admin.upload');
        Route::post('/admin/upload-books', [AdminController::class, 'uploadBooks'])->name('admin.upload.books');



    });

    // Member routes
    Route::middleware(['role:Member'])->group(function () {
        Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');
        Route::get('/member/books', [BookController::class, 'listBooks'])->name('member.books');
        Route::post('/member/books/borrow/{id}', [BookController::class, 'borrowBook'])->name('member.books.borrow');
        Route::post('/member/books/return/{id}', [BookController::class, 'returnBook'])->name('member.books.return');
        Route::get('/member/borrowed-books', [BookController::class, 'borrowedBooks'])->name('member.books.borrowed');


    });
});

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/test-email', function () {
    $details = [
        'subject' => 'Test Email from Library',
        'body' => 'Your book is overdued'
    ];

    Mail::raw($details['body'], function ($message) use ($details) {
        $message->to('recipient_email@example.com')
                ->subject($details['subject']);
    });

    return 'Email sent successfully!';
});
