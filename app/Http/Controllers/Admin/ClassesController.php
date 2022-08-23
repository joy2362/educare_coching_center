<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Routine;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    public function index(){
        $classes = Classes::where('deleted',"no")->get();
        return view('admin.pages.class.index',['classes'=>$classes]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.class.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:classes|max:255',
            'admission_fee' => 'required|numeric',
            'monthly_fee' => 'required|numeric',
            'other_fee' => 'required|numeric',
            'class_code' => 'required|numeric|unique:classes,class_code',
        ]);

        if($request->sub_name == null || count($request->sub_name) == 0){
            $validator->errors()->add('Subject','At least one subject required');
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
        try {
            DB::beginTransaction();
            $data = $request->only('name','admission_fee','monthly_fee','other_fee','class_code');
            $class =  Classes::create($data);
            $subject = [];
            foreach ($request->sub_name as $sub){
                $subject[] = ['name'=>$sub];
            }

            $class->subject()->createMany($subject);
            $batch = [];
            for ($i =0 ; $i < count($request->batch_name) ; $i++ ){
                $batch[] = [
                    'name' => $request->batch_name[$i],
                    'batch_start' => $request->class_start[$i],
                    'batch_end' => $request->class_end[$i],
                ];
            }
            $class->batch()->createMany($batch);
            DB::commit();
        }catch ( Exception $ex ){
            DB::rollBack();
            $notification = array(
                'messege' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        $notification=array(
            'messege'=>'Class Added Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $class = Classes::find($id);
        if ($class){
            return response()->json([
                'status' => 200,
                'class' => $class
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Class Not Found"
            ]);
        }
    }

    public function edit($id)
    {
       $class =  Classes::with('subject','batch')->find($id);

       return view('admin.pages.class.edit',['class'=>$class]);

    }

    public function update(Request $request,$id)
    {
        $validator = $this->formValidation($request);

        if($validator == true){
            try {
                DB::beginTransaction();

                $data = $request->only('name','admission_fee','monthly_fee','other_fee','class_code');
                Classes::find($id)->update($data);


                for ($i =0 ; $i < count($request->sub_name) ; $i++ ){

                    $subject['name'] = $request->sub_name[$i];
                    if(!empty($request->sub_id[$i])){
                        Subject::find($request->sub_id[$i])->update($subject);
                    }else{
                        $subject['class_id'] = $id;
                        Subject::created($subject);
                    }
                }



                for ($i =0 ; $i < count($request->batch_name) ; $i++ ){
                    $batch['name'] = $request->batch_name[$i];
                    $batch['batch_start'] = $request->class_start[$i];
                    $batch['batch_end'] = $request->class_end[$i];

                    if(!empty($request->batch_id[$i])){
                        Batch::find($request->batch_id[$i])->update( $batch);
                    }else{
                        $batch['class_id'] = $id;
                        Batch::created($subject);
                    }

                }

                DB::commit();
            }catch (Exception $ex){
                DB::rollBack();
               // dd($ex);
                $notification = array(
                    'messege' => $ex->getMessage(),
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        }else{
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
//            $notification=array(
//                'messege'=>'Something went wrong!',
//                'alert-type'=>'success'
//            );
//            return Redirect()->back()->with($notification);
        }

        $notification = array(
            'messege' => "class info Update!!",
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        $class = Classes::find($id);
        $class->status = "inactive";
        $class->deleted ="yes";
        $class->save();

        Subject::where('class_id',$id)->update(['deleted' => 'yes']);

        $batch = Batch::where('class_id',$id)->get();

        foreach ($batch as $row){
            Routine::where('batch_id',$row->id)->update(['deleted' => 'yes']);
        }

        Batch::where('class_id',$id)->update(['deleted' => 'yes']);

        $notification=array(
            'messege'=>'Class Delete Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function formValidation(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:classes|max:255',
            'admission_fee' => 'required|numeric',
            'monthly_fee' => 'required|numeric',
            'other_fee' => 'required|numeric',
            'class_code' => 'required|numeric|unique:classes,class_code',
        ]);

        if($request->sub_name == null || count($request->sub_name) == 0){
            $validator->errors()->add('Subject','At least one subject required');
            return $validator;
        }

        if ($validator->fails()) {
            return $validator;
        }
        return true;
    }


}
