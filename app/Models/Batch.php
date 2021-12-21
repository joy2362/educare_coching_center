<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name','class_id','batch_start','batch_end','status','deleted','isRoutine'
    ];
}