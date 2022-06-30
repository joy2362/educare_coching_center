<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\studentDetails;
use App\Trait\SendSmsTrait;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    use SendSmsTrait;

    public function create(){
        $classes =  Classes::all();
        return view('admin.pages.student.notice',['classes' =>$classes ]);
    }

    public function store(Request $request){
        $request->validate([
            'class' => 'required',
            'batch' => 'required',
            'message' => 'required',
        ]);

        $student = studentDetails::where('class_id',$request->input('class'))
            ->where('batch_id',$request->input('batch'))->get();
        
        $number = $this->prepare_number($student);
        $data = $this->prepare_data($number, $request->input('message'));
        $this->send($data);

        $notification=array(
            'messege'=>'Notice Send Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);

    }

    private function send_sms($number,$text){
        $user =env('BULKSMS_USER_ID');
        $password =env('BULKSMS_PASSWORD');

        $url = "http://66.45.237.70/api.php";

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
}
