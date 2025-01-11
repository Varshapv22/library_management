<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'ISBN',
        'published_date',
        'status',
        'borrowed_date',
        'due_date',
    ];
    protected $casts = [
        'borrowed_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function borrowedBooks()
{
    return $this->hasMany(Book::class, 'borrowed_by_user_id');
}

public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
