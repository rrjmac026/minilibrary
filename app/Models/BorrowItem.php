<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BorrowItem extends Model
{
    protected $fillable = ['borrow_id', 'book_id', 'returned', 'returned_at', 'fine'];

    protected $casts = [
        'returned'    => 'boolean',
        'returned_at' => 'datetime',
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Compute fine for this specific book item
    public function computeItemFine()
    {
        if ($this->returned) {
            return $this->fine; // already recorded when returned
        }

        $today   = Carbon::today();
        $dueDate = $this->borrow->due_date;

        if ($today->lte($dueDate)) {
            return 0;
        }

        return $today->diffInDays($dueDate) * 10; // ₱10 per day
    }
}