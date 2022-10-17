@extends('layout.master')
@section('title')
    <title>Menu</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Activity Log</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-border " id="data">
                                <thead>
                                <tr>
                                    <th>Subject type</th>
                                    <th>Subject id</th>
                                    <th>Event</th>
                                    <th>causer Type</th>
                                    <th>causer id</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $row)
                                    <tr>
                                        <td> {{$row->subject_type}}</td>
                                        <td> {{$row->subject_id}}</td>
                                        <td> {{$row->description}}</td>
                                        <td> {{$row->causer_type}}</td>
                                        <td> {{$row->causer_id}}</td>
                                        <td> <button type="button" onclick="view({{$row}})">View</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for view  -->
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="view_Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_Label">View Activity Log</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Subject Id</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Subject type</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Event</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <h6 class="mb-0">Causer type</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <h6 class="mb-0">Old Value</h6>
                                <p>

                                </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <h6 class="mb-0">New Value</h6>
                                <p id="newValue">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal for view  -->
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            $('#data').DataTable({
                "order": false
            });
        });
    });
        function view(item){
            Object.keys(item.properties).forEach(function(key){
                console.log(key);
               // document.getElementById('newValue').innerHTML = key, item.properties;
            });

            $('#view').modal('show');
            console.log(item)
        }
    </script>
@endsection