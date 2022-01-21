<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public function index($id){
        $class = Classes::find($id);

        $batches = DB::table('batches')
            ->where('batches.deleted',"no")
            ->join('classes', 'classes.id', '=', 'batches.class_id')
            ->where('classes.id',$id)
            ->select('batches.*','classes.name as class_name')
            ->get();
        return view('admin.pages.batch.index',['class'=>$class,'batches'=>$batches]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'class' => 'required',
            'batch_start' => 'required',
            'batch_end' => 'required',
        ]);

        $batch = new Batch();
        $this->query($request, $batch);
        $notification = array(
            'messege' => 'Batch Added Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $batch = Batch::find($id);

        if ($batch){
            return response()->json([
                'status' => 200,
                'batch' => $batch
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Batch Not Found"
            ]);
        }
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'class' => 'required',
            'batch_start' => 'required',
            'batch_end' => 'required',
        ]);

        $batch = Batch::find($request->id);

         $this->query($request, $batch);

        $notification = array(
            'messege' => 'Batch update Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     * @param $batch
     */
    public function query(Request $request, $batch)
    {
        $batch->class_id = $request->input('class');
        $batch->name = $request->input('name');
        $batch->batch_start = $request->input('batch_start');
        $batch->batch_end = $request->input('batch_end');
        $batch->save();
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        $batch = Batch::find($id);
        $batch->status = "inactive";
        $batch->deleted ="yes";
        $batch->save();

        Routine::where('batch_id',$id)->update(['deleted' => 'yes']);

        $notification=array(
            'messege'=>'Batch Delete Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}
