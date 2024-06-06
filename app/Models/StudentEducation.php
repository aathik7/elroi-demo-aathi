<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEducation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['student_id', 'qualification', 'year_of_passing', 'university_name'];
}
