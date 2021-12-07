@extends('layout.master')
@section('title')
    <title>Section</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Section
                <a href="#" class="float-end btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_section">Add New</a>
            </h1>
            <!-- Modal for add  -->
            <div class="modal fade" id="add_section" tabindex="-1" aria-labelledby="add_section_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_class_Label">Add Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.section.create')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select" id="class" name="class" required>
                                        @foreach($classes as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
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
            <div class="modal fade" id="edit_section" tabindex="-1" aria-labelledby="edit_section_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_section_Label">Edit Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.section.update')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                    <input type="hidden" id="edit_id" name="id" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_class" class="form-label">Class</label>
                                    <select class="form-select" id="edit_class" name="class" required>
                                        @foreach($classes as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
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
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->class_name}}</td>
                                            <td>{{$row->status}}</td>
                                            <td>
                                                <button class="m-2 btn btn-sm btn-primary edit_button" value="{{$row->id}}">Edit</button>
                                                <a class="m-2 btn btn-sm btn-danger" id="delete" href="{{url('/admin/section/delete/'.$row->id)}}">Delete</a>
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
        $(document).ready(function() {
            $('#section').DataTable();
        } );
    </script>
    <script>

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
                $('#edit_section').modal('show');
                ajaxsetup();
                $.ajax({
                    type:'get',
                    url:"/admin/section/show/"+id,
                    dataType:'json',
                    success: function(response){
                        if(response.status == 404){
                            $('#edit_brand').modal('hide');
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            )
                        }
                        else{
                            $('#edit_id').val(response.section.id);
                            $('#edit_name').val(response.section.name);
                            $('#edit_status1').checked = true;
                            if(response.section.status === 'active'){
                                $("#edit_status1").prop("checked", true);
                            }else{
                                $("#edit_status2").prop("checked", true);
                            }
                            $('#edit_class').val(response.section.class_id);
                        }
                    }
                })



            });
        } );

    </script>
@endsection