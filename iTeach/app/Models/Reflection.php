<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    use HasFactory;

    protected $table = "reflections";


    protected $fillable = [
        'title',
        'description',
        'resources',
        'assessment_id',
        'users_id',
        'class_id',
        'year_id'
    ];

public function teacher(){
    return $this->belongsTo(Teacher::class);
}

public function assessments(){
    return $this->hasMany(Assesment::class);
}

public function reflectionDetails(){
    return $this->hasMany(ReflectionDetail::class);
}

public function students(){
    return $this->belongsToMany(Student::class, 'reflection_student' ,'reflection_id','student_id','id');
}

public function class(){
    return $this->belongsTo(Classes::class,'class_id');
}

public function user(){
    return $this->belongsTo(User::class,'users_id');
}

}
check
