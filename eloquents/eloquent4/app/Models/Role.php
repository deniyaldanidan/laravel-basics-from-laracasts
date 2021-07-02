<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot('active');
    }
    public function active_members()
    {
        return $this->belongsToMany(Member::class, 'member_role', 'role_id', 'member_id')->wherePivot('active', 1);
    }
}
