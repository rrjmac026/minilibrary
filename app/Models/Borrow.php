<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrow extends Model
{
    protected $fillable = ['student_id', 'borrow_date', 'due_date', 'status'];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date'    => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function borrowItems()
    {
        return $this->hasMany(BorrowItem::class);
    }

    // Compute total fine for all items in this borrow
    public function computeFine()
    {
        $today = Carbon::today();

        if ($today->lte($this->due_date)) {
            return 0;
        }

        $overdueDays = $today->diffInDays($this->due_date);
        $unreturned  = $this->borrowItems()->where('returned', false)->count();

        return $overdueDays * $unreturned * 10; // ₱10 per day per book
    }
}
