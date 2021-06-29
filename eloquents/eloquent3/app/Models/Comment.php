<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function commentable()
    {
        return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
    }
}
