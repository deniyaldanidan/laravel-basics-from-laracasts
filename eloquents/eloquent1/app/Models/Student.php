<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    public function info(){
        return $this->hasOne(Info::class, 'student_id', 'id'); 
        // hasOne(Class, 'Foreign_key', 'Local_key)
    }

    public function homeworks(){
        return $this->hasMany(Homework::class, 'student_id', 'id');
        // hasMany(Class, 'Foreign_key', 'Local_key')
    }
}
