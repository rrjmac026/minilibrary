<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'total_copies', 'available_copies', 'description'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function borrowItems()
    {
        return $this->hasMany(BorrowItem::class);
    }

    // Check if book is available
    public function isAvailable()
    {
        return $this->available_copies > 0;
    }
}
