<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\studentDetails;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index(){
        $class = Classes::where('deleted','no')->where('status','active')->get();
        $batches = DB::table('batches')
            ->where('batches.deleted',"no")
            ->where('batches.status',"active")
            ->join('classes', 'classes.id', '=', 'batches.class_id')
            ->select('batches.*','classes.name as class_name')
            ->get();
        return view('admin.pages.exam.index',[ 'batches'=>$batches,'classes'=>$class ]);
    }

    public function store(Request $request){
        $request->validate([
            'batch' => 'required|numeric',
            'subject' => 'required|numeric',
            'exam_date' => 'required|date',
            'mark' => 'required|numeric',
        ]);

        $batch = Batch::find($request->batch);
        $batch->exams()->create([
           'exam_date' => $request->exam_date,
            'subject_id' =>$request->subject,
            'total_mark' =>$request->mark,
        ]);
        $subject = Subject::find($request->subject);
        $student = studentDetails::where('batch_id',$request->input('batch'))->get();
        $number= "";
        foreach ($student as $row){
            $number = $row->parent_contact_number.",".  $number ;
        }

        $this->SendSms($number,$subject->name,$request->mark,$request->exam_date);

        $notification=array(
            'messege'=>'Exam Date Added Successfully!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function show($id){
        $batch = Batch::find($id);
       // dd($batch->exams);
        return view('admin.pages.exam.show',['batch'=>$batch]);
    }

    private function SendSms($number,$subject,$total_mark ,$date){
        $user =env('BULKSMS_USER_ID');
        $password =env('BULKSMS_PASSWORD');

        $url = "http://66.45.237.70/api.php";

        $text = "New Exam Date ".$date." Subject- ".$subject." Mark- ".$total_mark. ".Best of luck.";
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

    public function destroy($id){
        Exam::destroy($id);
        $notification=array(
            'messege'=>'Exam Date Removed Successfully!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
