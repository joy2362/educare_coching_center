<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Routine;
use App\Models\studentDetails;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(){

        $student = studentDetails::find(Auth::guard('web')->user()->username);
        $class = Classes::find($student->class_id);
        $batch = Batch::find($student->batch_id);

        $routine = DB::table('routines')
            ->where('routines.batch_id',$student->batch_id)
            ->join('subjects', 'subjects.id', '=', 'routines.subject_id')
            ->select('routines.*','subjects.name as subject')
            ->get();
        return view('student.pages.dashboard',['student'=>$student,'class'=>$class,'batch'=>$batch,'routine'=>$routine]);
    }

    public function forgot_password(Request $request){

        $request->validate([
            'username' => 'required|max:255',
            'mobile_number' => 'required|regex:/(01)[0-9]{9}/',
        ]);

        $details = $this->check_details($request->input('mobile_number'),$request->input('username'));

        if(!isset($details)){
            return Redirect()->back()->with(array(
                'messege'=>'Student Details not Matched!',
                'alert-type'=>'error'
            ));
        }

        $password = Str::random('6');
        User::where('username',$details->id)->update([
            'password'=> Hash::make($password)
        ]);
        $this->SendSms($details->parent_contact_number,$password);

       return redirect('/login')->with(array(
           'messege'=>'New password send to your mobile number!',
           'alert-type'=>'success'
       ));

    }


    private function check_details($mobile ,$id){
        return studentDetails::where('parent_contact_number',$mobile)->where('id',$id)->first();
    }

    private function SendSms($number,$std_password){
        $user =env('BULKSMS_USER_ID');
        $password =env('BULKSMS_PASSWORD');

        $url = "http://66.45.237.70/api.php";

        $text = "Your Password change successfully. Your new password:".$std_password .".Don't share your account details with anyone.";
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
        curl_exec($ch);

    }

    public function exam_date(){
        $user = studentDetails::find(Auth::guard('web')->user()->username);
        $batch = Batch::find($user->batch_id);
        return view('student.pages.exam_date',['batch'=>$batch]);
    }

    public function exam_result(){
        $user = studentDetails::find(Auth::guard('web')->user()->username);
        return view('student.pages.result',['user'=>$user]);
    }
}
