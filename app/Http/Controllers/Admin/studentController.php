<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccontCreated;
use App\Models\Classes;
use App\Models\District;
use App\Models\Divisions;
use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {

        return view('admin.pages.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $divisions = Divisions::all();
        $classes =  Classes::all();
        return view('admin.pages.student.create',['divisions'=>$divisions,'classes'=>$classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|max:55',
            'dob' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'father_mobile_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'mother_mobile_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',
            'mobile_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'email' => 'required',
            'class' => 'required',
            'section' => 'required',
            'division' => 'required',
            'district' => 'required',
            'avatar' => 'required',
        ]);

        $student = DB::table('student_details')->insertGetId([
           'name' => $request->name,
           'father_name' => $request->father_name,
           'mother_name' => $request->mother_name,
           'father_mobile_number' => $request->father_mobile_number,
           'mother_mobile_number' => $request->mother_mobile_number,
           'father_occupation' => $request->father_occupation,
           'mobile_number' => $request->mobile_number,
           'present_address' => $request->present_address,
           'permanent_address' => $request->permanent_address,
           'gender' => $request->gender,
           'dob' => $request->dob,
           'district_id' => $request->district,
           'division_id' => $request->division,
           'class_id' => $request->class,
           'section_id' => $request->section,
        ]);

        $student_id = new User();
        $student_id->username = $request->mobile_number;
        $student_id->password = Hash::make($request->mobile_number);
        $student_id->details_id = $student;
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(30).'.'.$ext;
            $folder="asset/img/avatars/student";
            $url =$folder ."/".$fileName;
            $file->move($folder,$fileName);
            $student_id->avatar = $url;
        }
        $student_id->email = $request->email;
        $student_id->save();

        Mail::to($request->email)->send(new AccontCreated( $request->name , $student_id));

        $notification=array(
            'messege'=>'Student Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function districtList($id){
        $division = Divisions::find($id);
        $district = District::where('division_slug',$division->slug)->get();
        if ($district){
            return response()->json([
                'status' => 200,
                'district' => $district
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "District Not Found"
            ]);
        }
    }

    public function sectionList($id){
        $sections = section::where('class_id',$id)->get();
        if ($sections){
            return response()->json([
                'status' => 200,
                'sections' => $sections
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Sections Not Found"
            ]);
        }
    }
}
