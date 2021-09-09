<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'dateOfbirth',
        'current_address',
        'permanent_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Teacher::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function student()
    {
        return $this->classes()->withCount('students');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function reflections()
    {
        return $this->hasMany(Reflection::class);
    }
}
