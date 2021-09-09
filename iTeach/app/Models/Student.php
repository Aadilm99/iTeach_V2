<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'roll_number',
        'gender',
        'phone',
        'dateOfbirth',
        'current_address',
        'permanent_address',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }

    public function reflections(){
        return $this->belongsToMany(Reflection::class);
    }

}
