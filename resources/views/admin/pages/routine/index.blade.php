@extends('layout.master')
@section('title')
    <title>Routine</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Available Routine</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-border" id="routine">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Class Start</th>
                                        <th>Class End</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batches as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->class_name}}</td>
                                            <td>{{date('g:i a', strtotime($row->batch_start))}}</td>
                                            <td>{{date('g:i a', strtotime($row->batch_end))}}</td>
                                            <td>{{$row->status}}</td>
                                            <td>
                                                <a class="m-2 btn btn-sm btn-success" href="{{url('/admin/routine/show/'.$row->id)}}"> <i class="align-middle" data-feather="eye"></i></a>
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
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                $('#routine').DataTable();
            });
        });
    </script>
@endsection
