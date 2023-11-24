<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'address',
        'city',
        'dni',
        'semester',
    ];

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }

    public function sClasses()
    {
        return $this->belongsToMany(SClass::class, 'student_classes');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
