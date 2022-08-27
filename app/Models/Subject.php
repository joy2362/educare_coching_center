<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'name','class_id','status','deleted'
    ];

    //handle subject update with class
    public static function updateViaClass($class,$subjectName,$subjectId){
        if(!empty($subjectId)){
            Subject::whereNotIn('id',$subjectId)->delete();
        }
        for ($i =0 ; $i < count($subjectName) ; $i++ ){
            $subject['name'] = $subjectName[$i];

            if(!empty($subjectId[$i])){

                Subject::find($subjectId[$i])->update($subject);
            }else{
                $subject['class_id'] = $class;
                Subject::create($subject);
            }
        }
    }
}
