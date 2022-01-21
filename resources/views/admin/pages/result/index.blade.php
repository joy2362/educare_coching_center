@extends('layout.master')
@section('title')
    <title>Exam Date</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Exam Result</h1>
            <!-- Modal for update  -->
            <div class="modal fade" id="edit_batch" tabindex="-1" aria-labelledby="edit_batch_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_batch_Label">Edit Result</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.result.update')}}">
                            @csrf
                            <input type="hidden" name="result_id" id="result_id">
                            <div class="modal-body">
                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="Id" readonly  placeholder="id" >
                                        <label for="Id">Id</label>
                                    </div>
                                </div>

                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" readonly placeholder="name" >
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="subject" readonly value="{{$exam->subject->name}}">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="attendance" aria-label="Attendance" name="attendance" required>
                                            <option selected value="present">Present</option>
                                            <option value="absent">Absent</option>
                                        </select>
                                        <label for="attendance">Attendance</label>
                                    </div>
                                </div>
                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="result" placeholder="result" name="result" >
                                        <label for="result">Result</label>
                                    </div>
                                </div>
                                <div class="col-md g-2 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="mark" placeholder="mark" readonly >
                                        <label for="mark">Total Mark</label>
                                    </div>
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
                                <table class="table table-border" id="routine">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Attendance</th>
                                        <th>Total Mark</th>
                                        <th>Result</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exam->results as $row)
                                        <tr>
                                            <td>{{$row->student->id}}</td>
                                            <td>{{$row->student->name}}</td>
                                            <td>{{$exam->subject->name}}</td>
                                            <td>{{$row->attendance}}</td>
                                            <td>{{$row->total_mark}}</td>
                                            <td>{{$row->result}}</td>
                                            <td>
                                                <button class="m-2 btn btn-sm btn-primary edit_button" value="{{$row->id}}"> <i class="align-middle" data-feather="edit"></i></button>
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
                        url:"/admin/exam/result/show/"+id,
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
                                $('#result_id').val(response.result.id);
                                $('#Id').val(response.result.student_id);
                                $('#name').val(response.student.name);
                                $('#mark').val(response.result.total_mark);
                                $('#result').val(response.result.result);
                                $('#attendance').val(response.result.attendance);
                                $('#edit_batch').modal('show');
                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
