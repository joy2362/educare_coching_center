<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends BaseModel
{
    use HasFactory;

    /**
     * Get the parent imageable model (user or post).
     */
    public function examable()
    {
        return $this->morphTo();
    }

    protected $guarded = [];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'exam_id', 'id');
    }
}
