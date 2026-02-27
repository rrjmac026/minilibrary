<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = ['student_id', 'name', 'email', 'course'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
