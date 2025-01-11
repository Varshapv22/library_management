<?php
namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class BooksImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'title'         => $row['title'],
            'author'        => $row['author'],
            'ISBN'          => $row['isbn'],
            'published_date'=> Carbon::parse($row['published_date']),
            'status'        => $row['status'] ?? 'available',
        ]);
    }
}
