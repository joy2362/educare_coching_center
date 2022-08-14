<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\District;
use App\Models\Divisions;
use App\Models\studentDetails;
use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Traits\SendSmsTrait;
use App\Traits\StudentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $students = User::with(['details'=>function($q){
            $q->with(['class:id,name','batch:id,name','district:id,name','division:id,name']);
        }])->get();

        if($request->class && $request->batch){
            $students = User::with(['details'=>function($q) use($request){
                $q->with(['class:id,name' => function($q) use ($request) {
                    $q->where('id',$request->class);
                },'batch:id,name' =>function($q) use ($request) {
                    $q->where('id',$request->batch);
                },'district:id,name','division:id,name']);
            }])->get();
        }



        return view('admin.pages.student.index',['students'=>$students,'classes'=>$class]);
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

        $details = $this->student_create($request);

        $avatar = $this->upload( $request->file('avatar'),"avatar/student");

        $student = $this->user_create( $request->class , $details->id , $avatar, $request->email);
        
        $message = $this->admission($student['username'] , $student['password']);

        $data = $this->prepare_data($request->input('parent_contact_number'), $message);
        $class = Classes::find($request->class);
        $fee = [
            [
                'type' => 'admission fee',
                'amount' => $class->admission_fee,
            ],
            [
            'type' => 'other fee',
            'amount' => $class->other_fee,
            ],
            [
                'type' => 'monthly fee',
                'amount' => $class->monthly_fee,
            ]
        ];

        $student['user']->credit()->createMany($fee);
        
        $this->send($data);

        $notification=array(
            'messege'=>'Student Added Successfully!',
            'alert-type'=>'success'
        );

        return Redirect('/admin/student/'.$student['user']->id.'/show')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $student = User::with(['details'=>function($q){
                $q->with(['class:id,name','batch:id,name','district:id,name','division:id,name']);
            }])->find($id);
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
        $student = studentDetails::with('user','district:id,name','division:id,name','class:id,name','batch:id,name')->find($id);

        $division = Divisions::where('id',$student->division_id)->first();
        $batches = Batch::where('class_id',$student->class_id)->get();
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
}
