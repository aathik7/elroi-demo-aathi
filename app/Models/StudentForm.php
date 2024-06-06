<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentForm extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'hobbies'];

    public function education()
    {
        return $this->hasMany(StudentEducation::class, 'student_id');
    }
}
