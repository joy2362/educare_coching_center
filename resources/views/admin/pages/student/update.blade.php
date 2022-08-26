@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 text-center">{{$student->name}} Information Update</h1>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form method="post" action="{{url('admin/student/'.$student->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card ">
                            <div class="card-body text-center">
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror " placeholder="name" id="name" name="name" value="{{ $student->name }}">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="dob" id="dob" name="dob" value="{{ $student->dob }}" max="{{date('Y-m-d')}}" >
                                    <label for="dob">DOB</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" aria-label="Gender" name="gender" >
                                        <option selected value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('institute') is-invalid @enderror " placeholder="Institute" id="institute" name="institute" value="{{ $student->current_institute }}">
                                    <label for="institute">Current Institute</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" placeholder="father name" id="father-name" name="father_name" value="{{ $student->father_name }}">
                                    <label for="father-name">Father Name</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" placeholder="mother name" id="mother-name" name="mother_name" value="{{ $student->mother_name }}">
                                    <label for="mother-name">Mother Name</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" placeholder="Occupation" id="father-occupation" name="father_occupation" value="{{ $student->father_occupation }}">
                                    <label for="father-occupation">Father's Occupation</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('parent_contact_number') is-invalid @enderror" placeholder="Mobile number" id="parent-contact-number" name="parent_contact_number" value="{{ $student->parent_contact_number }}">
                                    <label for="parent-contact-number">Parent Contact number(+88)</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('emergency_contact_number') is-invalid @enderror" placeholder="Mobile number" id="emergency-contact-number" name="emergency_contact_number" value="{{ $student->emergency_contact_number }}">
                                    <label for="emergency-contact-number">Emergency Contact number(+88)</label>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    <textarea class="form-control @error('present_address') is-invalid @enderror" placeholder="present-address" id="present-address" name="present_address" style="height: 100px">{{ $student->present_address }}</textarea>
                                    <label for="present-address">Present Address</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <textarea class="form-control @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" id="permanent-address" name="permanent_address" style="height: 100px">{{ $student->permanent_address }}</textarea>
                                    <label for="permanent-address">Permanent Address</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <select class="form-select @error('division') is-invalid @enderror" id="division" aria-label="Division" name="division" >
                                        <option selected>....</option>
                                        @foreach($divisions as $row)
                                            @if($student->division_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="division">Division</label>
                                </div>
                                <div class="form-floating g-2 mb-3 district_class">
                                    <select class="form-select @error('district') is-invalid @enderror" id="district" aria-label="district" name="district" >
                                        @foreach($districts as $row)
                                            @if($student->district_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <label for="district">District</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    
                                    <img src="{{ $student->avatar }}" alt="{{$student->first_name}}" height="100px" width="100px" class="img-thumbnail m-3">
                                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" accept="image/*" name="avatar">
                                    <label for="formFile">Image</label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <select class="form-select @error('class') is-invalid @enderror" id="class" aria-label="Class" name="class" >
                                        @foreach($classes as $row)
                                            @if($student->class_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="class">Class</label>
                                </div>
                                <div class="form-floating g-2 mb-3 batch_class">
                                    <select class="form-select @error('batch') is-invalid @enderror" id="batch" aria-label="batch" name="batch" >
                                        @foreach($batches as $row)
                                            @if($student->batch_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="batch">Batch</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success g-2 float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
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

                $(document).on('change','#division',function(e){
                    let id = e.target.value;
                    ajaxsetup();
                    $.ajax({
                        type:'get',
                        url:"/admin/district/fetch/"+id,
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
                                let district =  $('#district').empty();
                                $.each(response.district,function(key,val){
                                    district.append('<option value ="'+val.id+'">'+val.name+'</option>');
                                });

                            }
                        }
                    })

                });
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

                });
            });
        });
    </script>
@endsection
