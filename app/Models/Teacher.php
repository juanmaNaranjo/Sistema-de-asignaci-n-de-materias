<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function sClass()
    {
        return $this->hasMany(sClass::class);
    }
}
