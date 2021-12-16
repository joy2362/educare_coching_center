<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoutineController extends Controller
{
    public function index(){
        $batches = DB::table('batches')
            ->where('batches.deleted',"no")
            ->where('batches.isRoutine',"yes")
            ->join('classes', 'classes.id', '=', 'batches.class_id')
            ->select('batches.*','classes.name as class_name')
            ->get();
        return view('admin.pages.routine.index',[ 'batches'=>$batches ]);
    }
    public function create($id){
        $batch = Batch::find($id);
        $class = Classes::find($batch->class_id);
        $subject = DB::table('subjects')
            ->where('subjects.deleted',"no")
            ->join('classes', 'classes.id', '=', 'subjects.class_id')
            ->where('subjects.class_id',$class->id)
            ->select('subjects.*','classes.name as class_name')
            ->get();
        return view('admin.pages.routine.create',['batch'=>$batch,'class' => $class , 'subject' =>$subject ]);

    }

    public function store(Request $request ,$id): \Illuminate\Http\RedirectResponse
    {
        $batch = Batch::find($id);
        $batch->isRoutine = "yes";
        $batch->save();

       foreach ($request->subject as $row){
           $days = $request->input("day_".$row);
           $days = implode(',', $days);

           $routine = new Routine();
           $routine->subject_id = $row;
           $routine->class_start = $request->input("startTime_".$row);
           $routine->class_end = $request->input("endTime_".$row);
           $routine->teacher_initial = $request->input("teacher_initial_".$row);
           $routine->day = $days;
           $routine->batch_id = $id;
           $routine->save();
       }

        $notification=array(
            'messege'=>'Routine Created Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->route('admin.routine.index')->with($notification);
    }

    public function show($id)
    {
        if (request()->wantsJson()){
            $routine = DB::table('routines')
                ->where('routines.id',$id)
                ->join('subjects', 'subjects.id', '=', 'routines.subject_id')
                ->select('routines.*','subjects.name as subject')
                ->first();

            if ($routine){
                $days = explode(',' , $routine->day);
                return response()->json([
                    'status' => 200,
                    'routine' => $routine,
                    'days' => $days
                ]);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => "Routine Not Found"
                ]);
            }
        }
        $batch = Batch::find($id);
        $class = Classes::find($batch->class_id);
        $subject = DB::table('subjects')
            ->where('subjects.deleted',"no")
            ->join('classes', 'classes.id', '=', 'subjects.class_id')
            ->where('subjects.class_id',$class->id)
            ->select('subjects.*','classes.name as class_name')
            ->get();
        $routine = DB::table('routines')
            ->where('routines.BATCH_id',$id)
            ->join('subjects', 'subjects.id', '=', 'routines.subject_id')
            ->select('routines.*','subjects.name as subject')
            ->get();
        return view('admin.pages.routine.show',['batch'=>$batch,'class' => $class , 'subject' =>$subject,'routine'=>$routine ]);



    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
       $routine = Routine::find($request->id);

        $days = $request->input("day");

        $days = implode(',', $days);
        $routine->day = $days;

        $routine->class_start = $request->input("startTime");
        $routine->class_end = $request->input("endTime");
        $routine->teacher_initial = $request->input("teacher_initial");

        $routine->save();

        $notification=array(
            'messege'=>'Routine Update Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
