@extends('layout.master')
@section('title')
    <title>Exam Date</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"> Exam Date</h1>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Total Mark</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batch->exams as $row)
                                        <tr>
                                            <td class="text-center">{{$row->subject->name}}</td>
                                            <td class="text-center">{{$row->exam_date}}</td>
                                            <td class="text-center">{{$row->total_mark}}</td>
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
