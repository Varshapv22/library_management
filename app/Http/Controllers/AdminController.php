<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessBookCsv;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showUploadForm()
    {
        return view('admin.upload-books');
    }

    public function uploadBooks(Request $request)
    {
        
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);


        $file = $request->file('file');
        $filePath = $file->store('uploads');


        ProcessBookCsv::dispatch(storage_path('app/' . $filePath));


        return redirect()->route('admin.dashboard')->with('success', 'CSV uploaded successfully! Processing...');
    }
}
