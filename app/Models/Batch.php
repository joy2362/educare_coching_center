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

    public function exams()
    {
        return $this->morphMany(Exam::class, 'examable');
    }
    public function students()
    {
        return $this->hasMany(studentDetails::class, 'batch_id', 'id');
    }

    public static function updateViaClass($class,$batchName,$batchStart,$batchEnd,$batchId){
        if(!empty($batchId)){
            Batch::whereNotIn('id',$batchId)->doesntHave('students')->delete();
        }
        for ($i =0 ; $i < count($batchName) ; $i++ ){
            $batch['name'] = $batchName[$i];
            $batch['batch_start'] = $batchStart[$i];
            $batch['batch_end'] = $batchEnd[$i];


            if(!empty($batchId[$i])){
                Batch::find($batchId[$i])->update( $batch);
            }else{
                $batch['class_id'] = $class;
                Batch::create($batch);
            }

        }
    }
}
