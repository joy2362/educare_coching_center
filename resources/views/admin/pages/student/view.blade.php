@extends('layout.master')
@section('title')
    <title>Student Details</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Student Details
                <a href="{{url('/admin/student/'.$student->details->id.'/print')}}" class="float-end mx-2 btn btn-sm btn-success rounded" >Admission Form</a>
                <a href="{{url('/admin/student-account/create?username='.$student->username)}}" class="float-end btn btn-sm btn-info rounded" >Make payment</a>
            </h1>

            <div class="row">
                <div class="col-12">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{$student->avatar ?? asset('asset/img/avatars/student/default.png')}}" alt="student" class="rounded-circle" width="150" height="150">
                                            <div class="mt-3">
                                                <h4>{{ucfirst($student->details->first_name)}} {{$student->details->last_name}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <h4 class="fw-bold text-center">Academic Info</h4>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Roll</h6>
                                            <span class="text-secondary">{{$student->username}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Class</h6>
                                            <span class="text-secondary">{{$student->details->class->name}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Batch</h6>
                                            <span class="text-secondary">{{$student->details->batch->name}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
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
                                                <h6 class="mb-0">Gender</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ucfirst($student->details->gender) ?? "-"}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date of Birth</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ucfirst($student->details->dob) ?? "-"}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Current institute</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ucfirst($student->details->current_institute) ?? "-"}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$student->details->contact_number ?? "-"}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guardian number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $student->details->parent_contact_number ?? '-'}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row gutters-sm">
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="d-flex align-items-center mb-3 fw-bold">Parent Info</h4>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Father name</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->father_name}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Father occupation</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->father_occupation}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Mother name</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->mother_name}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="d-flex align-items-center mb-3 fw-bold">Address</h4>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">District</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->district->name}}
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Division</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->division->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Present address</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->present_address}}
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                            <h6 class="mb-0">Permanent address</h6>
                                                        </div>
                                                        <div class="col-sm-8 text-secondary">
                                                            {{$student->details->permanent_address}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

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