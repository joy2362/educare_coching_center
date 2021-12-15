@extends('layout.master')
@section('title')
    <title>Routine</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Routine  <a href="{{redirect()->back()->getTargetUrl()}}" class=" btn btn-sm btn-info">Go Back</a>
                @if($section->isRoutine === "no")
                <a href="#" class="float-end btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_section">Add New</a>
                @endif
            </h1>
            <!-- Modal for add  -->
            <div class="modal fade" id="add_section" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="add_section_Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_class_Label">Add Routine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{url('/admin/section/routine/create/'.$section->id)}}">
                            @csrf
                            <div class="modal-body">
                                @foreach($subject as $row)
                                    <input type="hidden" name="subject[]" value="{{$row->id}}">
                                <div class="row mt-3">
                                    <div class="col-md-2 g-2">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control"  id="subject" value="{{$row->name}}" readonly>
                                    </div>
                                    <div class="col-md-4 g-2 ">
                                        <label for="day">Day</label>
                                        <select class="form-select" multiple id="day" required name="day_{{$row->id}}[]" >
                                            <option value="saturday">Saturday</option>
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="start">Class Start</label>
                                        <input type="time" class="form-control"  min="09:00" max="18:00" name="startTime_{{$row->id}}" id="start" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end">Class End</label>
                                        <input type="time" class="form-control"  min="09:00" max="18:00" name="endTime_{{$row->id}}" id="end" required>
                                    </div>
                                </div>
                                @endforeach
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
            <div class="modal fade" id="edit_routine" tabindex="-1" aria-labelledby="edit_routine_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_section_Label">Edit Routine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('admin.routine.update')}}">
                            @csrf
                            <input type="hidden" id="edit_id" name="id" >
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit_subject">Subject</label>
                                    <input type="text" class="form-control"  id="edit_subject"  readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_day">Day</label>
                                    <select class="form-select" multiple id="edit_day" required name="day[]" >
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
                                    <label for="edit_start">Class Start</label>
                                    <input type="time" class="form-control"  min="09:00" max="18:00" name="startTime" id="edit_start" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit_end">Class End</label>
                                    <input type="time" class="form-control"  min="09:00" max="18:00" name="endTime" id="edit_end" required>
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
                                        <th>Id</th>
                                        <th>Subject</th>
                                        <th>Day</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($routine as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->subject}}</td>
                                            @php
                                                 $days = explode(',' , $row->day);
                                            @endphp
                                            <td>
                                                @foreach($days as $day)
                                                {{ucfirst($day) }}
                                                @endforeach
                                            </td>
                                            <td>{{$row->class_start}}</td>
                                            <td>{{$row->class_end}}</td>
                                            <td>
                                                <button class="m-2 btn btn-sm btn-primary edit_button" value="{{$row->id}}">Edit</button>
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
                    $('#edit_routine').modal('show');
                    ajaxsetup();
                    $.ajax({
                        type:'get',
                        url:"/admin/section/routine/show/"+id,
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
                                $('#edit_id').val(response.routine.id);
                                $('#edit_subject').val(response.routine.subject);
                                $('#edit_start').val(response.routine.class_start);
                                $('#edit_end').val(response.routine.class_end);
                                $('#edit_day').val(response.days);

                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
