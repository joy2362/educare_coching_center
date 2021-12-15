<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Routine;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function index($id){
        $class = Classes::find($id);

        $section = DB::table('sections')
            ->where('sections.deleted',"no")
            ->join('classes', 'classes.id', '=', 'sections.class_id')
            ->where('classes.id',$id)
            ->select('sections.*','classes.name as class_name')
            ->get();

        return view('admin.pages.section.index',['class'=>$class,'sections'=>$section]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'class' => 'required',
        ]);

        $section = new section();
        $section->class_id = $request->class;
        $section->name = $request->name;
        $section->save();

        $notification=array(
            'messege'=>'Section Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function show($id){
        $section = section::find($id);
        if ($section){
            return response()->json([
                'status' => 200,
                'section' => $section
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Section Not Found"
            ]);
        }
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'class' => 'required',
        ]);

        $section = section::find($request->id);
        $section->name = $request->name;
        $section->class_id = $request->class;
        $section->status = $request->status;
        $section->save();

        $notification=array(
            'messege'=>'Section Update Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function destroy($id){

        $section = section::find($id);
        $section->status = "inactive";
        $section->deleted ="yes";
        $section->save();
        Routine::where('section_id',$id)->update(['deleted' => 'yes']);

        $notification=array(
            'messege'=>'Section Delete Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
