<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($id){
        $subject = DB::table('subjects')
            ->where('subjects.deleted',"no")
            ->where('subjects.status',"active")
            ->join('classes', 'classes.id', '=', 'subjects.class_id')
            ->where('subjects.class_id',$id)
            ->select('subjects.*','classes.name as class_name')
            ->get();

        $class = Classes::find($id);

        return view('admin.pages.class.subject',['subjects'=>$subject,'class'=>$class]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function subjectList($id){
        $subjects = Subject::where('class_id',$id)->where('status','active')->where('deleted','no')->get();

        if ($subjects){
            return response()->json([
                'status' => 200,
                'subjects' => $subjects
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Subject Not Found"
            ]);
        }
    }
}
