<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    use SendSmsTrait;

    public function create(){
        $classes =  Classes::all();
        return view('admin.pages.notice.index',['classes' => $classes ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'class' => 'required',
            'batch' => 'required',
            'message' => 'required',
        ]);

        if($request->student == null || count($request->student) == 0){
            $validator->errors()->add('student','Please select student');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $number = $this->prepareNumber($request->student);
        $data = $this->prepareSms($number, $request->input('message'));
        $this->send($data);

        $notification=array(
            'messege'=>'Notice Send Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}
