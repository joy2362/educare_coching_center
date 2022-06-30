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
           .basic_info td, th {
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
                min-width: 100px;
                background: white;
                box-sizing: border-box;
                text-align: left;
            }
            .admission{
                text-align: center;
                font-size: 25px;
            } 
            .signature{
                margin: 50px 2px;
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
                <img src="{{asset('asset/img/icons/logo.jpg')}}" class="logo" alt="logo" style="width:70px;height:70px;margin-right:15px;">
            </div>
             <p class="InstituteName">Educare Coaching Center</p>
             <small>19/c Shaheb Ali Road Notun Bazar Mymensingh</small>
        </div>

        <div>
            <h4 class="admission">Admission Form</h4>
        </div>

        <table class="basic_info">
            <tr>
                <td >
                    <span >Form No: 1234</span>
                </td>
                    <td>
                    <span>Date: 22/12/2022</span>
                </td>
                    <td>
                    <span>Roll No: 2022010016</span>
                </td>
                    <td rowspan="3">
                    <img src="{{asset('asset/img/avatars/83305.jpg')}}" class="logo" alt="logo" style="width:75px;height:100px;margin-left:5px;margin-right:5px;">
                </td>
            </tr>
                <tr>
                <td>
                    <span>Class: {{$class->name}}</span>
                </td>
                    <td>
                    <span>Batch: {{$batch->name}}</span>
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
                        <span class="text-center">Abdullah zahid</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Current Institute </span>
                    </td>
                     
                     <td colspan="3">
                        <span>Southeast University</span>
                    </td>
                </tr>
               
               
                 <tr>
                    <td >
                        <span >Contact No.: </span>
                    </td>
                     <td >
                        <span>+8801780134797</span>
                    </td>
                     <td>
                        <span>Email</span>
                    </td>
                     <td>
                        <span>Abdullahzahidjoy@gmail.com</span>
                    </td>
                </tr>
                 <tr >
                    <td >
                        <span >Date of birth:  </span>
                    </td>
                     <td >
                        <span>26/12/1998</span>
                    </td>
                     <td>
                        <span>Gender</span>
                    </td>
                    <td>
                        <span> Male</span>
                    </td>
                </tr>
                  <tr>
                    <td >
                        <span >Father's Name </span>
                    </td>
                     
                     <td colspan="3">
                        <span>Mr. x</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Profession </span>
                    </td>
                     
                     <td >
                        <span>Teacher</span>
                    </td>
                    <td>
                        <span>Contact No.:</span>
                    </td>
                    <td>
                        <span>+8801780134797</span>
                    </td>
                </tr>
                <tr>
                    <td >
                        <span >Mother's Name </span>
                    </td>
                     
                     <td colspan="3">
                        <span>Ms. y</span>
                    </td>
                </tr>
                 <tr>
                    <td >
                        <span >Emerg  Contact number </span>
                    </td>
                     
                     <td colspan="3">
                        <span>+8801780134797</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Division </span>
                    </td>
                     
                     <td >
                        <span>{{$division->name}}</span>
                    </td>

                     <td >
                        <span >District </span>
                    </td>
                     
                     <td>
                        <span>{{$district->name}}</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Permanent Address </span>
                    </td>
                     
                     <td colspan="3">
                        <span>Dhaka Bangladesh</span>
                    </td>
                </tr>

                 <tr>
                    <td >
                        <span >Present Address </span>
                    </td>
                     
                     <td colspan="3">
                        <span>Dhaka Bangladesh</span>
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
