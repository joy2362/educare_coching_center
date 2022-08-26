@extends('layout.master')
@section('title')
    <title>Class</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Class
                <a href="{{route('admin.class.create')}}" class="float-end btn btn-sm btn-success rounded" >Add New</a>
            </h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-border" id="classes">
                                    <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Name</th>
                                        <th>Admission Fee</th>
                                        <th>Monthly Fee</th>
                                        <th>Other Fee</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $class)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$class->name}}</td>
                                        <td>{{$class->admission_fee}}</td>
                                        <td>{{$class->monthly_fee}}</td>
                                        <td>{{$class->other_fee}}</td>
                                        <td> <span class="badge @if($class->status == "active") badge-success @else badge-danger @endif" >{{ucfirst($class->status)}}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn " type="button" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="align-middle" data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="m-2 dropdown-item" href="{{route('admin.class.edit',$class->id)}}">Edit</a>
                                                    <a class="m-2 dropdown-item" href="{{route('admin.class.show',$class->id)}}">View</a>
                                                    <a class="m-2 dropdown-item" id="delete" href="{{url('/admin/class/delete/'.$class->id)}}">Delete</a>
                                                </div>
                                            </div>
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
                $('#classes').DataTable();
            });
        });
    </script>
@endsection
