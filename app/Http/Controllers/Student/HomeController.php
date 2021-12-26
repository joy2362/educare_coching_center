<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\studentDetails;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $student = studentDetails::find(Auth::guard('web')->user()->username);
        $class = Classes::find($student->class_id);
        $batch = Batch::find($student->batch_id);
        $subject = Subject::where('class_id',$student->class_id)->get();
        return view('student.pages.dashboard',['student'=>$student,'class'=>$class,'batch'=>$batch,'subject'=>$subject]);
    }
}