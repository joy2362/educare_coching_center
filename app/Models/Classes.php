<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name','admission_fee','monthly_fee','other_fee','status','deleted'
    ];
}
