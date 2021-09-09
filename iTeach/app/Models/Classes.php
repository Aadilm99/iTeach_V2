<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'profile_image'
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class)->withPivot('classes_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function years()
    {
        return $this->belongsToMany(Years::class)->withPivot('classes_id', 'years_id');
    }
}
