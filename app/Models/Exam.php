<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
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
