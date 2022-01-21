<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentDetails extends Model
{
    use HasFactory;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name','father_name',
        'mother_name','parent_contact_number','emergency_contact_number',
        'father_occupation','present_address','permanent_address',
        'gender','current_institute','dob',
        'district_id','division_id','class_id', 'batch_id'
    ];

    public function results()
    {
        return $this->hasMany(Result::class, 'student_id', 'id');
    }
}
