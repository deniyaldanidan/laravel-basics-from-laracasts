<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'class', 'section', 'age'];

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
        // belongsTo(Class, 'Foriegn_key)
    }
}
