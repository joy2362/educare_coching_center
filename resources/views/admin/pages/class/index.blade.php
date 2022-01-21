@extends('layout.master')
@section('title')
    <title>Class</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Class
                <a href="#" class="float-end btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_class">Add New</a>
            </h1>
            <!-- Modal for add  -->
            <div class="modal fade" id="add_class" tabindex="-1" aria-labelledby="add_class_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_class_Label">Add Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="addBrandForm" action="{{route('admin.class.create')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="admission_fee" class="form-label">Admission Fee</label>
                                    <input type="number" class="form-control" id="admission_fee" name="admission_fee" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="monthly_fee" class="form-label">Monthly Fee</label>
                                    <input type="number" class="form-control" id="monthly_fee" name="monthly_fee" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="other_fee" class="form-label">Other Fee</label>
                                    <input type="text" class="form-control" id="other_fee" name="other_fee" required>
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
            <div class="modal fade" id="edit_class" tabindex="-1" aria-labelledby="edit_class_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_class_Label">Edit Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.class.update')}}" >
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                    <input type="hidden" id="edit_id" name="id" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_admission_fee" class="form-label">Admission Fee</label>
                                    <input type="number" class="form-control" id="edit_admission_fee" name="admission_fee" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_monthly_fee" class="form-label">Monthly Fee</label>
                                    <input type="number" class="form-control" id="edit_monthly_fee" name="monthly_fee" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_other_fee" class="form-label">Other Fee</label>
                                    <input type="text" class="form-control" id="edit_other_fee" name="other_fee" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label  class="form-label mr-4">Status: </label>
                                    <input class="form-check-input" type="radio" name="status" id="edit_status1" value="active" >
                                    <label class="form-check-label mr-4" for="edit_status1">
                                        Active
                                    </label>
                                    <input class="form-check-input" type="radio" name="status" id="edit_status2" value="inactive">
                                    <label class="form-check-label" for="edit_status2">
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
                                <table class="table table-border" id="classes">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
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
                                        <td>{{$class->id}}</td>
                                        <td>{{$class->name}}</td>
                                        <td>{{$class->admission_fee}}</td>
                                        <td>{{$class->monthly_fee}}</td>
                                        <td>{{$class->other_fee}}</td>
                                        <td>{{$class->status}}</td>
                                        <td>
                                            <button class="m-2 btn btn-sm btn-primary edit_button" value="{{$class->id}}"><i class="align-middle" data-feather="edit"></i></button>
                                            <a class="m-2 btn btn-sm btn-success" href="{{url('/admin/class/subject/'.$class->id)}}">Subject</a>
                                            <a class="m-2 btn btn-sm btn-info" href="{{url('/admin/class/batch/'.$class->id)}}">Batch</a>
                                            <a class="m-2 btn btn-sm btn-danger" id="delete" href="{{url('/admin/class/delete/'.$class->id)}}"><i class="align-middle" data-feather="trash-2"></i></a>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {

            function ajax_setup(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            $(document).on('click','.edit_button',function(e){
                e.preventDefault();
                let id = $(this).val();
                $('#edit_class').modal('show');
                ajax_setup();
                $.ajax({
                    type:'get',
                    url:"/admin/class/show/"+id,
                    dataType:'json',
                    success: function(response){
                        if(response.status === 404){
                            $('#edit_brand').modal('hide');
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            )
                        }
                        else{
                            $('#edit_id').val(response.class.id);
                            $('#edit_name').val(response.class.name);
                            $('#edit_admission_fee').val(response.class.admission_fee);
                            $('#edit_monthly_fee').val(response.class.monthly_fee);
                            $('#edit_other_fee').val(response.class.other_fee);

                            if(response.class.status === 'active'){
                                $("#edit_status1").prop("checked", true);
                            }else{
                                $("#edit_status2").prop("checked", true);
                            }
                        }
                    }
                })

            });
        });
        });
    </script>

@endsection
