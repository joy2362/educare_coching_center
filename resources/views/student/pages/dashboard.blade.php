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
                                    <div class="card-body">

                                        <table class="table table-striped table-success table-hover">
                                            <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>sat</th>
                                                <th>sun</th>
                                                <td>Mon</td>
                                                <td>tue</td>
                                                <td>wed</td>
                                                <td>thu</td>
                                                <td>fri</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($subject as $row)
                                            <tr>
                                                 <td>{{$row->name}}</td>
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
