<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id')->withDefault([
            'name' => 'unknown_student'
        ]);
        // belongsTo(Class, 'Foreign_key', 'Parent_key')
    }
}
