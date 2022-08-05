<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\Result;
use App\Models\studentDetails;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    use SendSmsTrait;

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

            $message = $this->result($exam->subject->name , $result, $request->mark);
            $data = $this->prepare_data($request->mobile[$i] , $message);
            $this->send($data);
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

}
