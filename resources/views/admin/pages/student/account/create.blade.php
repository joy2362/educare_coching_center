@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Add Payment</h1>

            <div class="row">
                <div class="col-12">
                    @if(empty($student))
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3" method="get" action="{{route('admin.student-account.create')}}">

                                <div class="col-auto">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Student Username">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{$student->avatar ?? asset('asset/img/avatars/student/default.png')}}" alt="student" class="rounded-circle" width="150" height="150">
                                            <div class="mt-3">
                                                <h4>{{ucfirst($student->details->first_name)}} {{$student->details->last_name}}</h4>
                                                <p class="text-secondary mb-1">{{$student->username}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <h5 class="fw-bold text-center">Recent payment history</h5>
                                    <ul class="list-group list-group-flush">
                                        @if(count($student->debit) >0)
                                            @foreach($student->debit as $debit)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">{{$debit->amount}} BDT</h6>
                                                    <span class="text-secondary">{{$debit->created_at->diffForHumans()}}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <h5 class="fw-bold text-center">No previous payment recode found</h5>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <form method="post" action="{{route('admin.student-account.store')}}">
                                    @csrf
                                    <div class="row gutters-sm">
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="d-flex align-items-center mb-3 fw-bold">Pending Due</h4>
                                                    @if(count($student->credit) > 0)
                                                        @php
                                                          $amount = 0;
                                                        @endphp
                                                    @foreach($student->credit as $credit)
                                                        @php
                                                        $amount += $credit->amount;
                                                        @endphp
                                                        <input type="hidden" name="id" value="{{$student->id}}">
                                                        <div class="form-group">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input due" checked type="checkbox" id="credit_{{$credit->id}}" name="credit[]" value="{{$credit->id}}" data-amount="{{$credit->amount}}">
                                                                <label class="form-check-label" for="credit_{{$credit->id}}">{{ucfirst($credit->type) . " (".$credit->amount . ")" }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                        <h5 class="fw-bold">No Pending credit found!!!</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="d-flex align-items-center mb-3 fw-bold">Payment</h4>
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $amount ?? 0}}">
                                                    </div>
                                                    <div class="form-group float-end">
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {

                $(document).on('change','.due',function(e){

                    var checkedValue = null;
                    $('input[name=checkbox]:checked').each(function()
                    {
                        console.log($(this).val() + ",");
                    }
                    );



                     
                });

            });
        });
    </script>
@endsection