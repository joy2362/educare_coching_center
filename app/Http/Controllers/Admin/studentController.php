<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\District;
use App\Models\Divisions;
use App\Models\User;
use App\Models\userDetail;
use App\Traits\FileUploadTrait;
use App\Traits\SendSmsTrait;
use App\Traits\StudentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class studentController extends Controller
{
    use SendSmsTrait , StudentTrait , FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $class = DB::table('classes')->where('status','active')->where('deleted',"no")->get();

        $query = User::with(['details'=>function($q){
            $q->with(['district:id,name','division:id,name']);
        },'class:id,name','batch:id,name']);

        if($request->class && $request->batch){
            $query->where('class_id',$request->class)->where('batch_id',$request->batch);
        }

        $students = $query->get();

        return view('admin.pages.student.index',['students' => $students,'classes' => $class]);
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
     */
    public function store(Request $request)
    {
       $this->store_validation($request);
        try {
            DB::beginTransaction();
            $password = Str::random('6');
            $userInfo = User::getUserInfo($request,$password);

            if($request->hasFile("avatar")){
                $userInfo['avatar'] = $this->upload( $request->file('avatar'),"avatar/student");
            }

            $user = User::create($userInfo);

            $details = userDetail::getData($request);
            $userDetails = $user->details()->create($details);

            $message = $this->admission($user->username , $password);
            $sms = $this->prepareSms($userDetails->parent_contact_number, $message);
            User::addAdmissionFee($user->id);
            $this->send($sms);

            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();

            $notification=array(
                'messege'=> $ex->getMessage(),
                'alert-type'=>'success'
            );

            return Redirect()->back()->with($notification);
        }

        $notification=array(
            'messege'=>'Student Admit Successfully!',
            'alert-type'=>'success'
        );

        return Redirect('/admin/student/'. $user->id.'/show')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $student = User::with(['details'=>function($q){
                $q->with(['district:id,name','division:id,name']);
            },'class','batch'])->find($id);


       return view('admin.pages.student.view',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        $divisions = Divisions::all();
        $classes =  Classes::all();

        $student = User::with(['details' => function($q){
            $q->with(['district:id,name','division:id,name']);
        },'class','batch'])->find($id);

        $division = Divisions::where('id',$student->details->division_id)->first();
        $batches = Batch::where('class_id',$student->details->class_id)->get();
        $districts = District::where('division_slug',$division->slug)->get();

        return view('admin.pages.student.update',['divisions'=>$divisions,'classes'=>$classes,'student'=>$student,'districts'=>$districts,'batches'=>$batches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:55',
            'dob' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'institute' => 'required',
            'parent_contact_number' => 'required|regex:/(01)[0-9]{9}/',
            'emergency_contact_number' => 'required|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',

            'present_address' => 'required',
            'permanent_address' => 'required',

            'class' => 'required',
            'batch' => 'required',
            'division' => 'required',
            'district' => 'required',
        ]);

        studentDetails::find($id)->update([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'current_institute' => $request->institute,
            'parent_contact_number' => $request->parent_contact_number,
            'emergency_contact_number' => $request->emergency_contact_number,
            'father_occupation' => $request->father_occupation,

            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'district_id' => $request->district,
            'division_id' => $request->division,
            'class_id' => $request->class,
            'batch_id' => $request->batch,
        ]);
        $user = User::where('username',$id)->first();
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(30).'.'.$ext;
            $folder="asset/img/avatars/student";
            $url =$folder ."/".$fileName;
            $file->move($folder,$fileName);
            unlink( $user->avatar);
            $user->avatar =  $url;
        }

        if($request->has('email')){
            $user->email = $request->email;
        }
        $user->save();

        $notification=array(
            'messege'=>'Student Update Successfully!',
            'alert-type'=>'success'
        );

        return redirect('/admin/student')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = studentDetails::find($id)->user()->first();
        $this->deleteFile($user->avatar);
       
        studentDetails::destroy($id);

        $notification=array(
            'messege'=>'Student Removed Successfully!',
            'alert-type'=>'success'
        );

        return redirect('/admin/student')->with($notification);

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

    public function printAdmissionForm($id){
      $user = studentDetails::with('user','district:id,name','division:id,name','class:id,name','batch:id,name')->find($id);
      $pdf = app('dompdf.wrapper');

      $pdf->loadView('pdf.admission' , compact('user'));

        return $pdf->stream($user->user->username.'.pdf');
        //return $pdf->download($user->user->username.'.pdf');
    }


    public function store_validation (Request $request){
        $request->validate([
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
            'dob' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'institute' => 'required',
            'parent_contact_number' => 'required|regex:/(01)[0-9]{9}/',
            'contact_number' => 'nullable|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',

            'present_address' => 'required',
            'permanent_address' => 'required',

            'class' => 'required',
            'batch' => 'required',

            'division' => 'required',
            'district' => 'required',
            'avatar' => 'required',
        ]);
    }
}
