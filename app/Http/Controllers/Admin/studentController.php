<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\District;
use App\Models\Divisions;
use App\Models\studentDetails;
use App\Models\User;
use App\Trait\SendSmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class studentController extends Controller
{
    use SendSmsTrait;
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $class = DB::table('classes')->where('status','active')->where('deleted',"no")->get();
        $students = studentDetails::with('district:id,name','division:id,name','class:id,name','batch:id,name')->get();


        if($request->class && $request->batch){
            $students =
            studentDetails::with('district:id,name','division:id,name','class:id,name','batch:id,name')->where('class_id',$request->class)->where('batch_id',$request->batch)->get();
           
        }else{
            $students = studentDetails::with('district:id,name','division:id,name','class:id,name','batch:id,name')->get();
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
    public function storeStudent(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
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
            'avatar' => 'required',
        ]);


        // $student = studentDetails::create([
        //     'first_name' => $request->firstname,
        //     'last_name' => $request->lastname,
        //     'father_name' => $request->father_name,
        //     'mother_name' => $request->mother_name,
        //     'current_institute' => $request->institute,
        //     'parent_contact_number' => $request->parent_contact_number,
        //     'emergency_contact_number' => $request->emergency_contact_number,
        //     'father_occupation' => $request->father_occupation,

        //     'present_address' => $request->present_address,
        //     'permanent_address' => $request->permanent_address,
        //     'gender' => $request->gender,
        //     'dob' => $request->dob,
        //     'district_id' => $request->district,
        //     'division_id' => $request->division,
        //     'class_id' => $request->class,
        //     'batch_id' => $request->batch,
        // ]);

        $student = new studentDetails();
        $student->first_name = $request->firstname;
        $student->last_name = $request->lastname;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->current_institute = $request->institute;
        $student->parent_contact_number = $request->parent_contact_number;
            $student->emergency_contact_number = $request->emergency_contact_number;
            $student->father_occupation = $request->father_occupation;
                $student->present_address = $request->present_address;
                $student->permanent_address = $request->permanent_address;
                    $student->gender =$request->gender;
                    $student->dob = $request->dob;
                        $student->district_id = $request->district;
                        $student->division_id = $request->division;
                            $student->class_id = $request->class;
                            $student->batch_id = $request->batch;
                                $student->save();

         
        $student_password = Str::random('6');

        $student_id = new User();
        $student_id->username = rand(1,9999);
        $student_id->student_details_id = $student->id;
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

        if($request->has('email')){
            $student_id->email = $request->email;
        }

        $student_id->save();

        $message = $this->admission($student->id ,$student_password);
        $data = $this->prepare_data($request->input('parent_contact_number'), $message);
        //$this->send($data);

        $notification=array(
            'messege'=>'Student Added Successfully!',
            'alert-type'=>'success'
        );

        if ($request->has('is_download')){
            $user = studentDetails::with('user','district:id,name','division:id,name','class:id,name','batch:id,name')->find($student->id);
           
            $pdf = app('dompdf.wrapper');

            $pdf->loadView('pdf.student_registation' , compact('user'));

            //return $pdf->stream($student.'.pdf');
            return $pdf->download($user->id.'.pdf');
        }

        return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {

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
        $student = DB::table('student_details')
            ->where('student_details.id',$id)
            ->join('users','users.username','=','student_details.id')
            ->select('student_details.*','users.email','users.avatar')
            ->first();
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
        studentDetails::destroy($id);
        $user = User::where('username',$id)->first();
        unlink($user->avatar);
        $user->delete();
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

    public function filter(Request $request){
        $request->validate([
            'class' => 'required',
            'batch' => 'required',
        ]);

        $students = DB::table('student_details')
            ->join('classes','classes.id','=','student_details.class_id')
            ->join('batches','batches.id','=','student_details.batch_id')
            ->join('districts','districts.id','=','student_details.district_id')
            ->join('divisions','divisions.id','=','student_details.division_id')
            ->where('classes.id',$request->class)
            ->where('batches.id',$request->batch)
            ->select('student_details.*','classes.name as class','batches.name as batch','districts.name as district','divisions.name as division')
            ->get();
        $class = DB::table('classes')->where('status','active')->where('deleted',"no")->get();
        //return redirect()->back()->with([['students'=>$students,'classes'=>$class]]);
        return view('admin.pages.student.index',['students'=>$students,'classes'=>$class]);
    }

}
