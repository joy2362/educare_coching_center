<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends BaseModel
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
