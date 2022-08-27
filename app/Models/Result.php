<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends BaseModel
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
