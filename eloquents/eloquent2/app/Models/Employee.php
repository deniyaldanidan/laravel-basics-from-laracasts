<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tasks(){
        return $this->hasManyThrough(Task::class, Colab::class, 'employee_id', 'project_id', 'id', 'project_id');
        // hasManyThrough(destination_model, Intermediate_model, foreign_key__intermediate_model, 
        // 'foreign_key__destiantion_model, local_id', 'secondary_id__intermediate_model')
    }
}
