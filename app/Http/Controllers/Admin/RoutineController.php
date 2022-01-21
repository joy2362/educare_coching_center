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
        $class = Classes::where('deleted','no')->get();
        $batches = DB::table('batches')
            ->where('batches.deleted',"no")
            ->join('classes', 'classes.id', '=', 'batches.class_id')
            ->select('batches.*','classes.name as class_name')
            ->get();
        return view('admin.pages.routine.index',[ 'batches'=>$batches,'classes'=>$class ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'class' => 'required|numeric',
            'batch' => 'required|numeric',
            'subject' => 'required|numeric',
            'teacher_initial' => 'required|max:255',
            'day' => 'required|max:255',
            'startTime' => 'required|max:255',
            'endTime' => 'required|max:255',
        ]);

       $routine = new Routine();
       $routine->subject_id = $request->input('subject');
       $routine->class_start = $request->input("startTime");
       $routine->class_end = $request->input("endTime");
       $routine->teacher_initial = $request->input("teacher_initial");
       $routine->day = $request->input('day');
       $routine->batch_id = $request->input('batch');
       $routine->save();

        $notification=array(
            'messege'=>'Routine Added Successfully!',
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
            ->where('routines.batch_id',$id)
            ->join('subjects', 'subjects.id', '=', 'routines.subject_id')
            ->select('routines.*','subjects.name as subject')
            ->get();
        return view('admin.pages.routine.show',['batch'=>$batch,'class' => $class , 'subject' =>$subject,'routine'=>$routine ]);



    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $routine = Routine::find($request->id);
        $routine->day = $request->input("day");

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
