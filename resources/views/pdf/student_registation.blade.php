<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admission Form</title>
        <style>
            .header_container{
                width: 100%;
                text-align: center;
            }
            .logo{
                margin: 0%;
            }
            .InstituteName{
                margin: 0%;
                line-height: 1.0;
                font-size: 30px;
                font-weight: bold;
            }
            .basic_info{
                font-family: 20px;
                font-weight: bold;
            }
           .basic_info_text {
                padding: 10px;
                min-width: 200px;
                background: white;
                box-sizing: border-box;
                text-align: left;
            }
            .pi{
                border-collapse: collapse;
            }
            .pi td, th {
                border: 1px solid #000;
                padding: 10px 5px;
                min-width: 175px;
                background: white;
                box-sizing: border-box;
                text-align: left;
            }
            .admission{
                text-align: center;
                font-size: 25px;
            } 
            .signature{
                margin: 40px 2px;
            }
            .gurdian{
                border-top: 2px solid #000;
                float: left;
                text-decoration-line: overline; 
            }         
        </style>
    </head>
    <body>
        <div class="header_container ">
            <div class="logo">
                <img src="{{asset('asset/img/icons/logo.jpg')}}" class="logo" alt="logo" style="width:70px;height:70px;">
            </div>
             <p class="InstituteName">Educare Coaching Center</p>
             <small>19/c Shaheb Ali Road Notun Bazar Mymensingh</small>
        </div>

        <div>
            <h4 class="admission">Admission Form</h4>
        </div>

        <table class="basic_info">
            <tr>
                <td class="basic_info_text">
                    <span >Form No: #{{str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</span>
                </td>
                    <td class="basic_info_text">
                    <span>Date: {{$user->created_at}}</span>
                </td>
                <td class="basic_info_text">
                    <span>Roll No: {{$user->user->username}}</span>
                </td>
                 <td rowspan="3">
                     <img src="{{$user->user->avatar}}" alt="{{$user->first_name . ' ' . $user->last_name}}" class="logo" alt="logo" style="width:75px;height:90px;margin-left:5px;margin-right:5px;">
                </td>
                   
            </tr>
            <tr>
                <td class="basic_info_text">
                    <span>Class: {{$user->class->name}}</span>
                </td>
                <td class="basic_info_text">
                    <span>Batch: {{$user->batch->name}}</span>
                </td>
               
            </tr>
        </table>
        <P>Personal information Section</P>
          <table class="pi">
                 <tr >
                    <td >
                        <span >Name of the student </span>
                    </td>
                     
                     <td colspan="3" >
                        <span class="text-center">{{$user->first_name . ' ' . $user->last_name}}</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Current Institute </span>
                    </td>
                     
                     <td colspan="3">
                        <span>{{$user->current_institute}}</span>
                    </td>
                </tr>
               
               
                 <tr>
                    <td >
                        <span >Contact No.: </span>
                    </td>
                     <td >
                        <span>{{$user->contact_number}}</span>
                    </td>
                     <td>
                        <span>Email</span>
                    </td>
                     <td>
                        <span>{{$user->user->gmail}}</span>
                    </td>
                </tr>
                 <tr >
                    <td >
                        <span >Date of birth: </span>
                    </td>
                     <td >
                        <span>{{$user->dob}}</span>
                    </td>
                     <td>
                        <span>Gender: {{$user->gender}}</span>
                    </td>
                    <td>
                        <span>Blood Group {{$user->blood_group}} </span>
                    </td>
                </tr>
                  <tr>
                    <td >
                        <span >Father's Name </span>
                    </td>
                     
                     <td colspan="3">
                        <span>{{$user->father_name}}</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Profession</span>
                    </td>
                     
                     <td >
                        <span>{{$user->father_occupation}}</span>
                    </td>
                    <td>
                        <span>P. Contact No.:</span>
                    </td>
                    <td>
                        <span>{{$user->parent_contact_number}}</span>
                    </td>
                </tr>
                <tr>
                    <td >
                        <span >Mother's Name </span>
                    </td>
                     
                     <td colspan="3">
                        <span>{{$user->mother_name}}</span>
                    </td>
                </tr>


                 <tr>
                    <td >
                        <span >Division </span>
                    </td>
                     
                     <td >
                        <span>{{$user->division->name}}</span>
                    </td>

                     <td >
                        <span >District </span>
                    </td>
                     
                     <td>
                        <span>{{$user->district->name}}</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Permanent Address </span>
                    </td>
                     
                     <td colspan="3">
                        <span>{{$user->permanent_address}}</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Present Address </span>
                    </td>
                     
                     <td colspan="3">
                        <span>{{$user->present_address}}</span>
                    </td>
                </tr>
        </table>
        <div class="signature">
            <p class="gurdian">
                Guardian's signature
            </p>
            <p class="author"></p>
        </div>
                
    </body>
</html>
