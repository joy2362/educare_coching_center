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

        $data['amount'] = $request->amount;
        $debit = User::find($request->id)->debit()->create($data);

        StudentCredit::whereIn('id',$request->credit)->update([
            'status'=>'paid'
        ]);

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
                $q->with(['class:name','batch:name']);
            }]);
        }])->find($id);
       // dd($debit);
        return view('admin.pages.student.account.view',['debit'=>$debit]);
    }

}
