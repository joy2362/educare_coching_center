<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
}
