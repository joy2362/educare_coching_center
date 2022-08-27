@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Student
                <a href="{{route('admin.student.create')}}" class="float-end btn btn-sm btn-success">Add New</a>
            </h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form class="row g-3" method="get" action="{{url('admin/student')}}">
                               
                                <div class="col-auto">
                                    <select class="form-select @error('class') is-invalid @enderror" name="class" id="class">
                                         <option value="" >Select Class</option>
                                        @foreach($classes as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select @error('batch') is-invalid @enderror" id="batch" aria-label="batch" name="batch" >
                                        <option value="" >Select Batch</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-border" id="student">
                                    <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Class</th>
                                        <th>Batch</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $students as $row)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$row->username}}</td>
                                                <td>{{$row->details->first_name . ' ' . $row->details->last_name}}</td>
                                                <td>{{ $row->details->contact_number ??  $row->details->parent_contact_number}}</td>
                                                <td>{{$row->class ? $row->class->name : '...'}}</td>
                                                <td>{{$row->batch ? $row->batch->name : '...' }}</td>
                                                <td>{{$row->details->division->name}}</td>
                                                <td>{{$row->details->district->name}}</td>
                                                <td>
                                                    <div class="btn-group dropleft">
                                                        <button class="btn " type="button" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="align-middle" data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="m-2 dropdown-item" href="{{route('admin.student.show',$row->id)}}"> View </a>
                                                            <a class="m-2 dropdown-item" href="{{route('admin.student.edit',$row->id)}}"> Edit </a>
                                                            <form method="post" action="{{ route('admin.student.destroy', $row->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="destroy" class="m-2 dropdown-item ">Delete</button>
                                                            </form>
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
                $('#destroy').on('click',function(e){
                    e.preventDefault();
                    var form = $(this).parents('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {form.submit();}
                    });

                });

                $('#student').DataTable();
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