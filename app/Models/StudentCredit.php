<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCredit extends BaseModel
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
