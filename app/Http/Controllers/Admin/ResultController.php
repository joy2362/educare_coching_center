<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\Result;
use App\Models\studentDetails;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index($id){
        $exam =Exam::find($id);
        return view('admin.pages.result.index',['exam'=>$exam]);
    }

    public function create($id){
       $exam = Exam::find($id);
        $batch = Batch::find($exam->examable_id);

        return view('admin.pages.result.create',['batch'=>$batch,'exam'=>$exam]);
    }

    public function store(Request $request){

        $exam = Exam::find($request->exam_id);
        for($i=0;$i<count($request->id);$i++){
            Result::create([
                'exam_id'=>$request->exam_id,
                'student_id' => $request->id[$i],
                'total_mark' => $request->mark,
                'result' => $request->result[$i],
                'attendance' => $request->attendance[$i]
            ]);
            $result = $request->result[$i]  ?? 0;
            $this->SendSms($request->mobile[$i] ,$exam->subject->name , $request->mark , $result);
        }

            $exam->result_published = 'yes';
            $exam->save();


        $notification = array(
            'messege' => 'Result Published Successfully!',
            'alert-type' => 'success'
        );

        return Redirect('/admin/exam')->with($notification);
    }

    public function show($id){
        $result  = Result::find($id);
        $student = studentDetails::find($result->student_id);
        $exam = Exam::find($result->exam_id);

        if ($result){
            return response()->json([
                'status' => 200,
                'result' => $result,
                'student' =>$student,
                'exam' =>$exam
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Result Not Found"
            ]);
        }

    }

    public function update(Request $request){
        Result::find($request->result_id)->update([
            'attendance' => $request->attendance,
            'result' => $request->result
        ]);
        $notification = array(
            'messege' => 'Result Updated Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    private function SendSms($number,$subject,$total,$result){
        $user =env('BULKSMS_USER_ID');
        $password =env('BULKSMS_PASSWORD');

        $url = "http://66.45.237.70/api.php";

        $text = "Result published for ".$subject." . Your result " .$result."/".$total.".";
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
