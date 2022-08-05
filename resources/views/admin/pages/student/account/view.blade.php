@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">View Payment Details</h1>

            <div class="row mt-6">
                <div class="col-12">
                        <div class="d-flex justify-content-center">

                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Roll</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                202212001
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                Abdullah zahid
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Amount </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$debit->amount}} BDT
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span class="badge @if($debit->status == "paid") badge-success @else badge-danger @endif">{{ucfirst($debit->status)}}</span>
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
