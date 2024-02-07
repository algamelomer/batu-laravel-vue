<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'user_id',
        'faculty_id',
        'name',
        'image',
        'title',
        'sub_title',
        'career',
        'experience',
        'scientific_interests'
        ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
