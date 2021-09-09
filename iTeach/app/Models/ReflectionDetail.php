<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReflectionDetail extends Model
{
    use HasFactory;

    protected $table = "reflection_details";

    protected $fillable = [
        'assessment_id',
        'reflection_id'
    ];

    public function reflection(){
        return belongsTo(Reflection::class, 'reflection_id', 'id');
    }

    // public function students(){
    //     return belongsToMany(Student::class, 'student_id', 'id');
    // }

    public function assessments(){
    return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
}
}
