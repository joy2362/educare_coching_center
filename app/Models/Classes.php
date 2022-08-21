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
    protected $guarded = [];

    public function subject(){
        return $this->hasMany(Subject::class,'class_id','id');
    }

    public function batch(){
        return $this->hasMany(Batch::class,'class_id','id');
    }

}
