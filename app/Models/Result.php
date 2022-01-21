<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->hasOne(studentDetails::class, 'id', 'student_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }

}
