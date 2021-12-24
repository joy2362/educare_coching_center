<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccontCreated;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\District;
use App\Models\Divisions;
use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
        $students = DB::table('student_details')
            ->join('classes','classes.id','=','student_details.class_id')
            ->join('batches','batches.id','=','student_details.batch_id')
            ->join('districts','districts.id','=','student_details.district_id')
            ->join('divisions','divisions.id','=','student_details.division_id')
            ->select('student_details.*','classes.name as class','batches.name as batch','districts.name as district','divisions.name as division')
            ->get();
        return view('admin.pages.student.index',['students'=>$students]);
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
     private function SendSms($number,$id,$student_password){
         $user =env('BULKSMS_USER_ID');
         $password =env('BULKSMS_PASSWORD');

         $url = "http://66.45.237.70/api.php";

         $text = "WELCOME TO EDUCARE.Admission Successful.Username:".$id ." Password:".$student_password;
         $data= array(
             'username'=>$user,
             'password'=> $password,
             'number'=>$number,
             'message'=>"$text"
         );

         $ch = curl_init(); // Initialize cURL
         curl_setopt($ch, CURLOPT_URL,$url);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $smsresult = curl_exec($ch);

         $p = explode("|",$smsresult);
         $sendstatus = $p[0];
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
            'institute' => 'required',
            'parent_contact_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'emergency_contact_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',
            'mobile_number' => 'required|unique:student_details|regex:/(01)[0-9]{9}/',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'email' => 'required',
            'class' => 'required',
            'batch' => 'required',
            'division' => 'required',
            'district' => 'required',
            'avatar' => 'required',
        ]);

        $student = DB::table('student_details')->insertGetId([
           'name' => $request->name,
           'father_name' => $request->father_name,
           'mother_name' => $request->mother_name,
           'current_institute' => $request->institute,
           'parent_contact_number' => $request->parent_contact_number,
           'emergency_contact_number' => $request->emergency_contact_number,
           'father_occupation' => $request->father_occupation,
           'mobile_number' => $request->mobile_number,
           'present_address' => $request->present_address,
           'permanent_address' => $request->permanent_address,
           'gender' => $request->gender,
           'dob' => $request->dob,
           'district_id' => $request->district,
           'division_id' => $request->division,
           'class_id' => $request->class,
           'batch_id' => $request->batch,
        ]);
        $student_password = Str::random('6');

        $student_id = new User();
        $student_id->username = $student;
        $student_id->password = Hash::make($student_password);

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

        $this->SendSms($request->input('parent_contact_number'),$student ,$student_password,);

        if ($request->input('email')){
            Mail::to($request->email)->send(new AccontCreated( $request->name , $student_id,$student_password)) ;
        }

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

    public function batchList($id){
        $batches = Batch::where('class_id',$id)->get();
        if ($batches){
            return response()->json([
                'status' => 200,
                'batches' => $batches
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Batch Not Found"
            ]);
        }
    }
}
