<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index($id){
        $subject = DB::table('subjects')
            ->where('subjects.deleted',"no")
            ->join('classes', 'classes.id', '=', 'subjects.class_id')
            ->where('subjects.class_id',$id)
            ->select('subjects.*','classes.name as class_name')
            ->get();

        $class = Classes::find($id);

        return view('admin.pages.class.subject',['subjects'=>$subject,'class'=>$class]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $section = new Subject();
        $section->class_id = $request->id;
        $section->name = $request->name;
        $section->save();

        $notification=array(
            'messege'=>'Subject Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function show($id){
        $subject = Subject::find($id);
        if ($subject){
            return response()->json([
                'status' => 200,
                'subject' => $subject
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Subject Not Found"
            ]);
        }
    }
    public function destroy($id){

        $subject = Subject::find($id);
        $subject->status = "inactive";
        $subject->deleted ="yes";
        $subject->save();

        $notification=array(
            'messege'=>'Subject Delete Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->class_id = $request->class;
        $subject->status = $request->status;
        $subject->save();

        $notification=array(
            'messege'=>'Subject Update Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
