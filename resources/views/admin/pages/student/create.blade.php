@extends('layout.master')
@section('title')
    <title>Student</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Admission Form</h1>
            <div class="row">
                <div class="col-12">
                   <form method="post" action="{{route('admin.student.store')}}" enctype="multipart/form-data">
                       @csrf

                       <div class="row g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('name') is-invalid @enderror " placeholder="name" id="name" name="name" value="{{ old('name') }}">
                                   <label for="name">Name</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="dob" id="dob" name="dob" value="{{ old('dob') }}">
                                   <label for="dob">DOB</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <select class="form-select @error('dob') is-invalid @enderror" id="gender" aria-label="Gender" name="gender" >
                                       <option selected value="male">Male</option>
                                       <option value="female">Female</option>
                                   </select>
                                   <label for="gender">Gender</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('father_name') is-invalid @enderror" placeholder="father name" id="father-name" name="father_name" value="{{ old('father_name') }}">
                                   <label for="father-name">Father Name</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('mother_name') is-invalid @enderror" placeholder="mother name" id="mother-name" name="mother_name" value="{{ old('mother_name') }}">
                                   <label for="mother-name">Mother Name</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('father_mobile_number') is-invalid @enderror" placeholder="Mobile number" id="father-mobile-number" name="father_mobile_number" value="{{ old('father_mobile_number') }}">
                                   <label for="father-mobile-number">Father's Mobile number</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('mother_mobile_number') is-invalid @enderror" placeholder="Mobile number" id="mother-mobile-number" name="mother_mobile_number" value="{{ old('mother_mobile_number') }}">
                                   <label for="mother-mobile-number">Mother's Mobile number</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md-6">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" placeholder="Occupation" id="father-occupation" name="father_occupation" value="{{ old('father_occupation') }}">
                                   <label for="father-occupation">Father's Occupation</label>
                               </div>
                           </div>

                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                                   <label for="email">Email</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile number" id="mobile-number" name="mobile_number" value="{{ old('mobile_number') }}">
                                   <label for="mobile-number">Mobile number</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <textarea class="form-control @error('present_address') is-invalid @enderror" placeholder="present-address" id="present-address" name="present_address" style="height: 100px">{{ old('present_address')}}</textarea>
                                   <label for="present-address">Present Address</label>
                               </div>
                           </div>
                           <div class="col-md">
                               <div class="form-floating">
                                   <textarea class="form-control @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" id="permanent-address" name="permanent_address" style="height: 100px">{{ old('permanent_address')}}</textarea>
                                   <label for="permanent-address">Permanent Address</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-5 g-2">
                           <div class="col-md">
                               <div class="form-floating">
                                   <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" accept="image/*" name="avatar">
                                   <label for="formFile">Avatar</label>
                               </div>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-outline-primary g-2 mt-5 float-right">Save</button>
                    <!--
                           <table cellpadding="9" width="30%" bgcolor="99FFFF" align="center"
                                  cellspacing="2">

                               <tr>
                                   <td colspan=2>
                                       <center><font size=4><b>Student Admission Form</b></font></center>
                                   </td>
                               </tr>

                               <tr>
                                   <td>Name</td>
                                   <td><input type=text name=textnames id="textname" size="30"></td>
                               </tr>

                               <tr>
                                   <td>Father's Name</td>
                                   <td><input type="text" name="fathername" id="fathername"
                                              size="30"></td>
                               </tr>
                               <tr>
                               <tr>
                                   <td>Father's Occupation</td>
                                   <td><input type="text" name="occupation" id="fatheroccupation"
                                              size="30"></td>
                               </tr>
                               <tr>
                                   <td>Mother's Name</td>
                                   <td><input type="text" name="mothername" id="mothername"
                                              size="30"></td>
                               </tr>
                               <td>Mother's Mobile</td>
                               <td><input type="text" name="mobile" id="mobile" size="30"></td>
                               </tr>
                               <tr>
                                   <td>Permanent Address</td>
                                   <td><input type="text" name="paddress" id="paddress" size="30"></td>
                               </tr>

                               <tr>
                                   <td>Present Address</td>
                                   <td><input type="text" name="personaladdress"
                                              id="personaladdress" size="30"></td>
                               </tr>
                               <tr>
                                   <td>DOB</td>
                                   <td><input type="text" name="dob" id="dob" size="30"></td>
                               </tr>
                               <tr>
                                   <td>Mobile</td>
                                   <td><input type="text" name="mobileno" id="mobileno" size="30"></td>
                               </tr>
                               <tr>
                               <tr>
                                   <td>Email</td>
                                   <td><input type="text" name="email" id="email" size="30"></td>
                               </tr>

                               <tr>
                                   <td>Sex</td>
                                   <td><input type="radio" name="sex" value="male" size="10">Male
                                       <input type="radio" name="sex" value="Female" size="10">Female
                                       <input type="radio" name="sex" value="Other" size="10">Other</td>
                               </tr>

                               <tr>
                                   <td>Class</td>
                                   <td><select name="Class">
                                           <option value="-1" selected>select..</option>
                                           <option value="Five">Five</option>
                                           <option value="Six">Six</option>
                                           <option value="Seven">Seven</option>
                                           <option value="Eight">Eight</option>
                                           <option value="Nine">Nine</option>
                                           <option value="Ten">Ten</option>
                                           <option value="SSc">SSC</option>
                                           <option value="Eleven">Eleven</option>
                                           <option value="Twelve">Twelve</option>
                                           <option value="HSc">HSC</option>
                                       </select></td>
                               </tr>

                               <tr>
                                   <td>District</td>
                                   <td><select name="District">
                                           <option value="-1" selected>select..</option>
                                           <option value="Dhaka">Dhaka</option>
                                           <option value="Mymensingh">Mymensingh</option>
                                           <option value="Jamalpur">Jamalpur</option>
                                           <option value="Sherpur">Sherpur</option>
                                           <option value="Kishoegonj">Kishoegonj</option>
                                           <option value="Netrokona">Netrokona</option>
                                           <option value="Rajshahi">Rajshahi</option>
                                           <option value="Pabna">Pabna</option>
                                           <option value="Tangail">Tangail</option>
                                           <option value="Gazipur">Gazipur</option>
                                           <option value="Khulna">Khulna</option>
                                           <option value="Dinajpur">Dinajpur</option>
                                           <option value="Lalmonirhat">Lalmonirhat</option>
                                           <option value="Rangpur">Rangpur</option>
                                           <option value="Sylhet">Sylhet</option>
                                       </select></td>
                               </tr>
                               <tr>
                                   <td>Division</td>
                                   <td><select name="City">
                                           <option value="-1" selected>select..</option>
                                           <option value="Dhaka">Dhaka</option>
                                           <option value="Mymensingh">Mymensingh</option>
                                           <option value="Khulna">Khulna</option>
                                           <option value="Rajshahi">Rajshahi</option>
                                           <option value="Sylhet">Sylhet</option>
                                           <option value="Chattogram">Chattogram</option>
                                           <option value="Barisal">Barisal</option>
                                           <option value="Rangpur">Rangpur</option>
                                       </select></td>
                               </tr>
                               <td><input type="reset"></td>
                               <td colspan="2"><input type="submit" value="Submit"/></td>
                               </tr>
                           </table>
                           -->
                   </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>

    </script>
@endsection
