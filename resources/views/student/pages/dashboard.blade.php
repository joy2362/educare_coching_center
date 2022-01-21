@extends('layout.master')
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"> Dashboard</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="text-center">Class Time {{date('g:i a', strtotime($batch->batch_start))}} - {{date('g:i a', strtotime($batch->batch_end))}}</h3>
                                    </div>
                                    <div class="card-body">

                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Subject</th>
                                                <th class="text-center">Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($routine as $row)
                                                    <tr>
                                                        <td ><p class="text-center">  {{$row->subject}}</p></td>
                                                        <td> <p class="text-center">{{$row->day}} <br> ( {{date('g:i a', strtotime($row->class_start))}} - {{date('g:i a', strtotime($row->class_end))}} )</p></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
@section("script")

@endsection
