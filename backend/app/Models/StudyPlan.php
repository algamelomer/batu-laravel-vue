<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'Lecturer',
        'academic_year',
        'semester',
        'credits',
        'user_id',
        'department_id'
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
