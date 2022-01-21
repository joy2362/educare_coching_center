@extends('layout.master')
@section('title')
    <title>Exam Date</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Exam  <a href="{{route('admin.exam.index')}}" class=" btn btn-sm btn-info">Go Back</a>
            </h1>

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
                                        <th>Total Mark</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batch->exams as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->subject->name}}</td>
                                            <td>{{$row->total_mark}}</td>
                                            <td>{{date('g:i a', strtotime($row->exam_date))}}</td>
                                            <td>
                                                @if($row->result_published == 'no')
                                                    <a class="m-2 btn btn-sm btn-primary"  href="{{url('/admin/exam/result/create/'.$row->id)}}">Published Result</a>
                                                @else
                                                    <a class="m-2 btn btn-sm btn-primary"  href="{{url('/admin/exam/result/'.$row->id)}}">View Result</a>
                                                @endif

                                                <a class="m-2 btn btn-sm btn-danger" id="delete" href="{{url('/admin/exam/delete/'.$row->id)}}"><i class="align-middle" data-feather="trash-2"></i></a>
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

                    ajax_setup();
                    $.ajax({
                        type:'get',
                        url:"/admin/routine/show/"+id,
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
                                $('#edit_id').val(response.routine.id);
                                $('#edit_subject').val(response.routine.subject);
                                $('#edit_start').val(response.routine.class_start);
                                $('#edit_teacher_initial').val(response.routine.teacher_initial);
                                $('#edit_end').val(response.routine.class_end);
                                $('#edit_day').val(response.days);
                                $('#edit_routine').modal('show');
                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
