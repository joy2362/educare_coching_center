@extends('layout.master')
@section('title')
    <title>Result</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"> Result</h1>
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
                                        <th class="text-center">Result</th>
                                        <th class="text-center">Total Mark</th>
                                        <th class="text-center">Attendance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->results as $row )
                                           <tr>
                                               <td class="text-center">{{$row->exam->subject->name}}</td>
                                               @if(!$row->result)
                                                   <td class="text-center">--</td>
                                               @else
                                                   <td class="text-center">{{$row->result}}</td>
                                                   @endif
                                               <td class="text-center">{{$row->total_mark}}</td>
                                               <td class="text-center">{{$row->attendance}}</td>
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
