<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <style>
        .student_section{
            height: 500px;
            margin-bottom: 10px;
        }
        .office_section{
            margin-top: 50px;
        }
        .header_container{
            width: 100%;
            text-align: center;
        }
        .logo{
            margin: 0;
        }

        .InstituteName{
            margin: 0;
            line-height: 1.0;
            font-size: 24px;
            font-weight: bold;
        }
        .basic_info{
            width: 100%;
            font-size: 15px;
            font-weight: bold;
        }
        .basic_info_text {
            width: 50%;
        }
        .date{
            text-align: right;
        }
        .pi{
            border-collapse: collapse;
        }
        .pi td, th {

            padding: 10px 5px;
            min-width: 175px;
            background: white;
            box-sizing: border-box;
            text-align: left;
        }
        .admission{
            text-align: center;
            font-size: 18px;
        }
        .signature{
            float: right;
            margin-top: 20px;
        }
        .guardian{
            border-top: 1px solid #000;
            float: left;
        }
        .value{
            border-bottom: 2px dotted;

        }
        .divider{
            border-top: 2px dotted #0a0a0a;
        }
    </style>
</head>
<body>
<div class="student_section">
    <div class="header_container ">
        <div class="logo">
            <img src="{{asset('asset/img/icons/logo.jpg')}}" class="logo" alt="logo" style="width:70px;height:70px;">
        </div>
        <p class="InstituteName">Educare Coaching Center</p>
        <small>19/c Shaheb Ali Road Notun Bazar Mymensingh</small>
    </div>

    <div>
        <h4 class="admission">Money Receipt (student copy)</h4>
    </div>

    <table class="basic_info">
        <tr>
            <td class="basic_info_text">
                <span >Sl No: #{{str_pad($debit->sl_no, 3, '0', STR_PAD_LEFT) }}</span>
            </td>
            <td class="basic_info_text date">
                <span>Date: {{$debit->created_at->format('d-M-Y')}}</span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
            <span >
                Student name:
                <span class="value">{{ ucfirst($debit->student->details->first_name ?? "-")}} {{ $debit->student->details->last_name ?? "-"}}</span>
            </span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
            <span >
                Class:
                <span class="value">{{ ucfirst($debit->student->class->name ?? "-")}}</span>
            </span>
            </td>
            <td >
            <span >
                Batch:
                <span class="value">{{ ucfirst($debit->student->batch->name ?? "-")}}</span>
            </span>
            </td>
            <td >
            <span >
                Id:
                <span class="value"> {{$debit->student->username ?? "-"}}</span>
            </span>
            </td>
        </tr>
    </table>
    <table class="pi">
        <tr>
            <td >
            <span >
                Amount:
                <span class="value"> {{$debit->amount ?? "-"}} Tk</span>
            </span>
            </td>
        </tr>
    </table>
    <div class="signature">
        <p class="guardian">
            signature
        </p>
        <p class="author"></p>
    </div>
</div>
<div class="divider"></div>
<div class="office_section">
    <div class="header_container ">
        <div class="logo">
            <img src="{{asset('asset/img/icons/logo.jpg')}}" class="logo" alt="logo" style="width:70px;height:70px;">
        </div>
        <p class="InstituteName">Educare Coaching Center</p>
        <small>19/c Shaheb Ali Road Notun Bazar Mymensingh</small>
    </div>

    <div>
        <h4 class="admission">Money Receipt (office copy)</h4>
    </div>

    <table class="basic_info">
        <tr>
            <td class="basic_info_text">
                <span >Sl No: #{{str_pad($debit->sl_no, 3, '0', STR_PAD_LEFT) }}</span>
            </td>
            <td class="basic_info_text date">
                <span>Date: {{$debit->created_at->format('d-M-Y')}}</span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
            <span >
                Student name:
                <span class="value">{{ ucfirst($debit->student->details->first_name ?? "-")}} {{ $debit->student->details->last_name ?? "-"}}</span>
            </span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
            <span >
                Class:
                <span class="value">{{ ucfirst($debit->student->class->name ?? "-")}}</span>
            </span>
            </td>
            <td >
            <span >
                Batch:
                <span class="value">{{ ucfirst($debit->student->batch->name ?? "-")}}</span>
            </span>
            </td>
            <td >
            <span >
                Id:
                <span class="value"> {{$debit->student->username ?? "-"}}</span>
            </span>
            </td>
        </tr>
    </table>
    <table class="pi">
        <tr>
            <td >
            <span >
                Amount:
                <span class="value"> {{$debit->amount ?? "-"}} Tk</span>
            </span>
            </td>
        </tr>
    </table>
    <div class="signature">
        <p class="guardian">
            signature
        </p>
        <p class="author"></p>
    </div>
</div>


</body>
</html>
