<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(){
        $classes = Classes::where('deleted',"no")->get();
        return view('admin.pages.class.index',['classes'=>$classes]);
    }

    public function store(Request $request){
       $request->validate([
            'name' => 'required|max:255',
       ]);
       $class = new Classes();
       $class->name = $request->name;
       $class->save();

        $notification=array(
            'messege'=>'Class Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function show($id){
        $class = Classes::find($id);
        if ($class){
            return response()->json([
                'status' => 200,
                'class' => $class
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Brand Not Found"
            ]);
        }
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $class = Classes::find($request->id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->save();

        $notification=array(
            'messege'=>'Class Update Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function destroy($id){

        $class = Classes::find($id);
        $class->status = "inactive";
        $class->deleted ="yes";
        $class->save();

        $notification=array(
            'messege'=>'Class Delete Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
