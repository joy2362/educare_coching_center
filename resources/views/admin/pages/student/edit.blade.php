@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h2 mb-3 text-center fw-bold ">Update student</h1>
            <div class="d-flex">
                <div class="col">
                    <form method="post" action="{{url('admin/student/'.$student->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card ">
                            <div class="card-body text-center">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <input type="text" class="form-control @error('firstname') is-invalid @enderror " placeholder="First Name" id="firstname" name="firstname" value="{{ $student->details->first_name }}">
                                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <input type="text" class="form-control @error('lastname') is-invalid @enderror " placeholder="Last Name" id="lastname" name="lastname" value="{{ $student->details->last_name }}">
                                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="dob" id="dob" name="dob" value="{{  $student->details->dob }}" max="{{date('Y-m-d')}}" >
                                            <label for="dob">DOB <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group" aria-label="blood_group" name="blood_group" >
                                                <option value="">Select Blood group</option>
                                                <option value="A+"  @if( $student->details->blood_group == "A+" ) selected @endif>A positive (A+)</option>
                                                <option value="A-"  @if( $student->details->blood_group == "A-" ) selected @endif>A negative (A-)</option>
                                                <option value="B+" @if( $student->details->blood_group == "B+" ) selected @endif>B positive (B+)</option>
                                                <option value="B-"  @if( $student->details->blood_group == "B-" ) selected @endif>B negative (B-)</option>
                                                <option value="O+"  @if( $student->details->blood_group == "O+" ) selected @endif>O positive (O+)</option>
                                                <option value="O-"  @if( $student->details->blood_group == "O-" ) selected @endif>O negative (O-)</option>
                                                <option value="AB+"  @if( $student->details->blood_group == "AB+" ) selected @endif>AB positive (AB+)</option>
                                                <option value="AB-"  @if( $student->details->blood_group == "AB-" ) selected @endif>AB negative (AB-)</option>
                                            </select>
                                            <label for="blood_group">Blood Group</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" aria-label="Gender" name="gender" >
                                                <option value="male" @if( $student->details->gender == "male" ) selected @endif>Male</option>
                                                <option value="female" @if( $student->details->gender == "female" ) selected @endif>Female</option>
                                            </select>
                                            <label for="gender">Gender<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('institute') is-invalid @enderror " placeholder="Institute" id="institute" name="institute" value="{{ $student->details->current_institute }}">
                                    <label for="institute">Current Institute<span class="text-danger">*</span></label>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" placeholder="father name" id="father-name" name="father_name" value="{{ $student->details->father_name }}">
                                    <label for="father-name">Father Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" placeholder="mother name" id="mother-name" name="mother_name" value="{{ $student->details->mother_name }}">
                                    <label for="mother-name">Mother Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" placeholder="Occupation" id="father-occupation" name="father_occupation" value="{{ $student->details->father_occupation }}">
                                    <label for="father-occupation">Father's Occupation<span class="text-danger">*</span></label>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror" placeholder="Contact number" id="contact-number" name="contact_number" value="{{ $student->details->contact_number }}">
                                            <label for="contact-number">Contact number(+88)</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <input type="text" class="form-control @error('parent_contact_number') is-invalid @enderror" placeholder="Contact number" id="parent-contact-number" name="parent_contact_number" value="{{ $student->details->parent_contact_number }}">
                                            <label for="parent-contact-number">Parent Contact number(+88)<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ $student->email }}">
                                    <label for="email">Email</label>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <textarea class="form-control @error('present_address') is-invalid @enderror" placeholder="present-address" id="present-address" name="present_address" style="height: 100px">{!! $student->details->present_address !!}  </textarea>
                                            <label for="present-address">Present Address<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <textarea class="form-control @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" id="permanent-address" name="permanent_address" style="height: 100px"> {!! $student->details->permanent_address !!} </textarea>
                                            <label for="permanent-address">Permanent Address<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <select class="form-select @error('division') is-invalid @enderror" id="division" aria-label="Division" name="division" >
                                                <option selected>....</option>
                                                @foreach($divisions as $row)
                                                    @if($student->details->division_id == $row->id)
                                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="division">Division<span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-floating g-2 mb-3 district_class">
                                            <select class="form-select @error('district') is-invalid @enderror" id="district" aria-label="district" name="district" >
                                                <option selected>....</option>
                                                @foreach($districts as $row)
                                                    @if($student->details->district_id == $row->id)
                                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="district">District<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating g-2 mb-3">
                                    @if($student->avatar)
                                    <img src="{{ $student->avatar }}" alt="{{$student->first_name}}" height="100px" width="100px" class="img-thumbnail m-3">
                                    @endif
                                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" accept="image/*" name="avatar">
                                    <label for="formFile">Image</label>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating g-2 mb-3">
                                            <select class="form-select @error('class') is-invalid @enderror" id="class" aria-label="Class" name="class" >
                                                <option >....</option>
                                                @foreach($classes as $row)
                                                    @if($student->class_id == $row->id)
                                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="class">Class<span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-floating g-2 mb-3 batch_class">
                                            <select class="form-select @error('batch') is-invalid @enderror" id="batch" aria-label="batch" name="batch" >
                                                <option >....</option>
                                                @foreach($batches as $row)
                                                    @if($student->batch_id == $row->id)
                                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="batch">Batch<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg g-2 float-right">Update</button>
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
