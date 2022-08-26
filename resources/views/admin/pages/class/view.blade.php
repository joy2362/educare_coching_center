@extends('layout.master')
@section('title')
    <title>Class</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Class
                <a href="{{route('admin.class.index')}}" class="float-end btn btn-sm btn-success">All Class</a>
            </h1>

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    {{$class->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Unique code</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    {{$class->class_code}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Admission Fee</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    {{$class->admission_fee}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Monthly Fee</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    {{$class->monthly_fee}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Other Fee</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    {{$class->other_fee}}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 class="fw-bold text-center">Subject</h4>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                @if(count($class->subject) >0)
                                @foreach($class->subject as $subject)
                                <div class="col-sm-4 text-secondary mt-3 text-center">
                                    {{$loop->index+1}}) {{$subject->name}}
                                </div>

                                @endforeach
                                @else
                                    <div class="col-sm-6 text-secondary mt-3 text-center">
                                       No subject found!!!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="fw-bold">Batch</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-border" id="batch">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class Start</th>
                                        <th>Class End</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class->batch as $row)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{date('g:i a', strtotime($row->batch_start))}}</td>
                                            <td>{{date('g:i a', strtotime($row->batch_end))}}</td>
                                            <td>
                                                <a class="m-2 btn btn-sm btn-success" href="{{url('/admin/routine/show/'.$row->id)}}">Routine</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                $('#batch').DataTable();
            });
        });
    </script>
@endsection
