<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Routine;
use App\Models\section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function index(){
        $classes = Classes::where('deleted',"no")->get();
        return view('admin.pages.class.index',['classes'=>$classes]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
       $request->validate([
            'name' => 'required|unique:classes|max:255',
            'admission_fee' => 'required|numeric',
            'monthly_fee' => 'required|numeric',
            'other_fee' => 'required|numeric',
       ]);
       $class = new Classes();
       $class->name = $request->input('name');
       $class->admission_fee = $request->input('admission_fee');
       $class->monthly_fee = $request->input('monthly_fee');
       $class->other_fee = $request->input('other_fee');
       $class->save();

        $notification=array(
            'messege'=>'Class Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $class = Classes::find($id);
        if ($class){
            return response()->json([
                'status' => 200,
                'class' => $class
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Class Not Found"
            ]);
        }
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $class = Classes::find($request->id);
        $class->name = $request->input('name');
        $class->admission_fee = $request->input('admission_fee');
        $class->monthly_fee = $request->input('monthly_fee');
        $class->other_fee = $request->input('other_fee');
        $class->status = $request->input('status');
        $class->save();

        $notification=array(
            'messege'=>'Class Update Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        $class = Classes::find($id);
        $class->status = "inactive";
        $class->deleted ="yes";
        $class->save();

        Subject::where('class_id',$id)->update(['deleted' => 'yes']);

        $batch = Batch::where('class_id',$id)->get();

        foreach ($batch as $row){
            Routine::where('batch_id',$row->id)->update(['deleted' => 'yes']);
        }

        Batch::where('class_id',$id)->update(['deleted' => 'yes']);

        $notification=array(
            'messege'=>'Class Delete Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }


}
