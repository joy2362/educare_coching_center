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
            margin: 0;
        }
        .InstituteName{
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }
        .info{
            margin-top: 5px;
            height: 80px;
            width: 100%;
        }
        .avatar{
            float: right;
            width: 15%;
        }
        .basic_info{
            float: left;
            width: 65%;
            font-size: 15px;

        }
        .sl_date{
            width: 100%;
        }
        .basic_info_text {
            font-weight: bold;
            text-align: left;
        }
        .sl_no{
            width: 50%;
            font-weight: bold;
            text-align: left;
        }
        .date{
            width: 50%;
            font-weight: bold;
            text-align: right;
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
            font-size: 20px;
        }
        .signature{
            margin: 40px 2px;
            float: right;
        }
        .guardian{
            border-top: 1px solid #000;
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
<table class="sl_date">
    <tr>
        <td class="sl_no">
            <span >Sl No: #{{str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</span>
        </td>
        {{--                <td class="date">--}}
        {{--                    <span>Date: {{$user->created_at}}</span>--}}
        {{--                </td>--}}
    </tr>
</table>

<div class="info">
    <table class="basic_info">

        <tr>
            <td class="basic_info_text">
                <span>Roll No: {{$user->user->username}}</span>
            </td>
            <td class="basic_info_text">
                <span>Class: {{$user->class->name}}</span>
            </td>
            <td class="basic_info_text">
                <span>Batch: {{$user->batch->name}}</span>
            </td>
        </tr>
    </table>
    <div class="avatar">
        <img src="{{$user->user->avatar ?? asset('asset/img/avatars/student/default.png')}}" alt="{{$user->first_name . ' ' . $user->last_name}}" class="logo"  style="width:75px;height:90px;margin-left:5px;margin-right:5px;">
    </div>
</div>

<P>Personal information </P>
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
    <p class="guardian">
        Guardian's signature
    </p>
    <p class="author"></p>
</div>

</body>
</html>
