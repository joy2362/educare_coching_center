@extends('layout.master')
@section('title')
    <title>Routine</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Routine
                <a href="#" class="float-end btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_routine">Add New</a>
            </h1>
            <!-- Modal for add  -->
            <div class="modal fade" id="add_routine" tabindex="-1" aria-labelledby="add_routine_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_class_Label">Add Routine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="addRoutineForm" action="{{route('admin.routine.create')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select" name="class" id="class" >
                                        <option selected>Select class</option>
                                        @foreach($classes as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group g-2 mb-3 batch_class">
                                    <label for="batch">Batch</label>
                                    <select class="form-select @error('batch') is-invalid @enderror" id="batch" aria-label="batch" name="batch" >
                                        <option selected>....</option>
                                    </select>
                                </div>
                                <div class="form-group g-2 mb-3 batch_class">
                                    <label for="subject">Subject</label>
                                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" aria-label="subject" name="subject" >
                                        <option selected>....</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="teacher_initial">Teacher Initial</label>
                                    <input type="text" class="form-control"  id="teacher_initial" name="teacher_initial" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="day">Day</label>
                                    <select class="form-select" id="day" required name="day" >
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start">Class Start</label>
                                    <input type="time" class="form-control" min="06:00" max="20:00"  name="startTime" id="start" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end">Class End</label>
                                    <input type="time" class="form-control"  min="06:00" max="20:00" name="endTime" id="end"  required>
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
                function ajaxsetup(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }
                $(document).on('change','#class',function(e){
                    let id = e.target.value;
                    ajaxsetup();
                    $.ajax({
                        type:'get',
                        url:"/admin/batch/fetch/"+id,
                        dataType:'json',
                        success: function(response){
                            if(response.status === 404){
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                )
                            }
                            else{
                                let batches =  $('#batch').empty();
                                $.each(response.batches,function(key,val){
                                    batches.append('<option value ="'+val.id+'">'+val.name + " - "+val.batch_start+ " - " + val.batch_end +'</option>');
                                });
                            }
                        }
                    })
                    $.ajax({
                        type:'get',
                        url:"/admin/subject/fetch/"+id,
                        dataType:'json',
                        success: function(response){
                            if(response.status === 404){
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                )
                            }
                            else{
                                let subject =  $('#subject').empty();
                                $.each(response.subjects,function(key,val){
                                    subject.append('<option value ="'+val.id+'">'+val.name +'</option>');
                                });
                            }
                        }
                    })

                });
            });
        });

    </script>
@endsection
