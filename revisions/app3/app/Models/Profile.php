<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['firstname', 'lastname', 'country', 'state', 'city', 'twitter', 'instagram', 'birthdate', 'occupation', 'company', 'about', 'gender', 'phone'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
