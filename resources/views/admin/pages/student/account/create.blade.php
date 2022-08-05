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
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Roll</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$student->username}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ucfirst($student->details->first_name)}} {{$student->details->last_name}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Blood Group</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ucfirst($student->details->blood_group) ?? "-"}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$student->details->contact_number ?? $student->details->parent_contact_number}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$student->details->permanent_address}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{route('admin.student-account.store')}}">
                                    @csrf
                                    <div class="row gutters-sm">
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="d-flex align-items-center mb-3 fw-bold">Pending Credits</h4>
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
                                                                <input class="form-check-input" checked type="checkbox" id="credit_{{$credit->id}}" name="credit[]" value="{{$credit->id}}">
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
        $(document).ready(function() {

        });
    </script>
@endsection
@section('style')

        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }



@endsection