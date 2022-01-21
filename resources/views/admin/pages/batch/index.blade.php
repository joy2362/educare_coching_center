@extends('layout.master')
@section('title')
    <title>Batch</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Batch <a href="{{url('/admin/class')}}" class=" btn btn-sm btn-info"><i class="align-middle" data-feather="corner-up-left"></i></a>
                <a href="#" class="float-end btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_batch">Add New</a>
            </h1>
            <!-- Modal for add  -->
            <div class="modal fade" id="add_batch" tabindex="-1" aria-labelledby="add_batch_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_class_Label">Add Batch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.batch.create')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" class="form-control" id="class" value="{{$class->name}}" required readonly>
                                    <input type="hidden" value="{{$class->id}}" name="class" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start">Class Start</label>
                                    <input type="time" class="form-control"  min="06:00" max="20:00" name="batch_start" id="start" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end">Class End</label>
                                    <input type="time" class="form-control"  min="06:00" max="20:00" name="batch_end" id="end" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end Modal for add-->

            <!-- Modal for update  -->
            <div class="modal fade" id="edit_batch" tabindex="-1" aria-labelledby="edit_batch_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_batch_Label">Edit Batch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.batch.update')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                    <input type="hidden" id="edit_id" name="id" >
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        <label for="class" class="form-label">Class</label>
                                        <input type="text" class="form-control" id="class" value="{{$class->name}}" required readonly>
                                        <input type="hidden" value="{{$class->id}}" name="class" >
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_start">Class Start</label>
                                    <input type="time" class="form-control"  min="06:00" max="20:00" name="batch_start" id="edit_start" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_end">Class End</label>
                                    <input type="time" class="form-control"  min="06:00" max="20:00" name="batch_end" id="edit_end" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label  class="form-label mr-4">Status: </label>
                                    <input class="form-check-input" type="radio" name="status" id="edit_status1" value="active" >
                                    <label class="form-check-label mr-4" for="edit_status1">
                                        Active
                                    </label>
                                    <input class="form-check-input" type="radio" name="status" id="edit_status2" value="inactive">
                                    <label class="form-check-label mr-4" for="edit_status2">
                                        Inactive
                                    </label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end Modal for update  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-border" id="section">
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
                                                <button class="m-2 btn btn-sm btn-primary edit_button" value="{{$row->id}}"> <i class="align-middle" data-feather="edit"></i></button>
                                                <a class="m-2 btn btn-sm btn-success" href="{{url('/admin/routine/show/'.$row->id)}}">Routine</a>
                                                <a class="m-2 btn btn-sm btn-danger" id="delete" href="{{url('/admin/batch/delete/'.$row->id)}}"> <i class="align-middle" data-feather="trash-2"></i></a>
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
                $('#section').DataTable();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {

                function ajaxsetup(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }

                $(document).on('click','.edit_button',function(e){
                    e.preventDefault();
                    let id = $(this).val();
                    ajaxsetup();
                    $.ajax({
                        type:'get',
                        url:"/admin/batch/show/"+id,
                        dataType:'json',
                        success: function(response){
                            if(response.status === 404){
                                $('#edit_batch').modal('hide');
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                )
                            }
                            else{

                                $('#edit_id').val(response.batch.id);
                                $('#edit_name').val(response.batch.name);
                                $('#edit_start').val(response.batch.batch_start);
                                $('#edit_end').val(response.batch.batch_end);

                                if(response.batch.status === 'active'){
                                    $("#edit_status1").prop("checked", true);
                                }else{
                                    $("#edit_status2").prop("checked", true);
                                }
                                $('#edit_batch').modal('show');
                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
