<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
