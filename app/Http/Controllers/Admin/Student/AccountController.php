<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentCredit;
use App\Models\StudentDebit;
use App\Models\User;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    use SendSmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $debits = StudentDebit::with('student')->orderBy('id','desc')->get();

         return view('admin.pages.student.account.index',['debits' => $debits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!empty($request->username)){
            $student = User::with(['details','credit' => function($q){
                $q->where('status','pending');
            },'debit'=> function($q){
                $q->orderBy('id','desc')->take(5);
            }])->where('username',$request->username)->first();
        }else{
            $student = null;
        }
        return view('admin.pages.student.account.create',['student'=>$student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);

        if($request->credit == null  || count($request->credit) == 0){
            $validator->errors()->add('credit','Please select credit');
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
        
        $lastDebit = StudentDebit::latest('id')->first();
        $data['sl_no'] = $lastDebit && $lastDebit->sl_no ? $lastDebit->sl_no + 1 : 1001;
        
        $data['amount'] = $request->amount;

        $debit = User::find($request->id)->debit()->create($data);

        $paid = $request->amount;
        $credits = StudentCredit::whereIn('id',$request->credit)->get();

        foreach($credits as $credit){
            $credit->update([
                'status'=>'paid'
            ]);
            if($credit->amount > $paid){
                $data = now()->format("Ym");
                $due['amount'] = $credit->amount - $paid;
                $due['type'] = "Due";
                $due['date'] = $data;
                User::find($request->id)->credit()->create($due);
            }

            $paid -= $credit->amount;

        }

        $student = User::with('details')->find($request->id);

        $message = $this->payment();
        $data = $this->prepare_data($student->details->parent_contact_number , $message);
        $this->send($data);

        $notification=array(
            'messege'=>'Payment Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.student-account.show',$debit->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $debit = StudentDebit::with(['student'=> function($q){
            $q->with(['details'=>function($q){
                $q->with(['class:id,name','batch:id,name']);
            }]);
        }])->find($id);
       // dd($debit);
        return view('admin.pages.student.account.view',['debit'=>$debit]);
    }

    public function print($id){
        $debit = StudentDebit::with(['student'=> function($q){
            $q->with(['details'=>function($q){
                $q->with(['class:id,name','batch:id,name']);
            }]);
        }])->find($id);

        $pdf = app('dompdf.wrapper');

        $pdf->loadView('pdf.payment' , ['debit'=>$debit]);

        return $pdf->stream($debit->sl_no.'.pdf');
        //return $pdf->download($user->user->username.'.pdf');
    }

    public function addCredit(){
        $students = User::with(['details'=>function($q){
            $q->with(['class:id,monthly_fee']);
        }])->get();
        foreach ($students as $student ){
            $data['amount'] = $student->details->class->monthly_fee;
            $data['type'] = "monthly fee";
           $student->credit()->create($data);
        }


        $notification=array(
            'messege'=>'Credit Added Successfully!',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

}
