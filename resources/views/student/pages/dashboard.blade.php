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
                                                <th>day</th>
                                                <th>8:30Am - 9:30am</th>
                                                <th>9:30Am - 11:00am</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>sat</td>
                                            </tr>
                                            <tr>
                                                <td>sun</td>
                                            </tr>
                                            <tr>
                                                <td>Mon</td>
                                            </tr>
                                            <tr>
                                                <td>tue</td>
                                            </tr>
                                            <tr>
                                                <td>wed</td>
                                            </tr>
                                            <tr>
                                                <td>thr</td>
                                            </tr>
                                            <tr>
                                                <td>fri</td>
                                            </tr>
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
