<?php
namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\BooksImport;

class ProcessBookCsv implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        // Process CSV using Excel import
        Excel::import(new BooksImport, $this->filePath);

        // Optionally, delete the file after processing
        Storage::delete($this->filePath);
    }
}
