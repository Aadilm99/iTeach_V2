<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = "assessments";

    protected $id = 'assessment_id';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'assessment_id');
    }

    public function reflection(){
        return $this->belongsTo(Reflection::class);
    }
}
