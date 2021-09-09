<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Years extends Model
{
    use HasFactory;

    protected $fillable = [
        'years',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }
}
