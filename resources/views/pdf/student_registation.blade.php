<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Form - {{$student}}</title>

    <style>
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        .admission{
            margin-left: 15px;
            margin-right: 15px;
            width: 100%;

        }
        .admission h3{
            margin-left: 15px;
            text-align: center;
            font-size: 30px;
            text-decoration: underline;
        }

        .admission p {
            font-size: 18px;
        }
        .information {
            background-color: #6c0202;
            color: #FFF;
        }
        .information table {
            text-align: center;
        }
        .information table tr  h3{
            font-size: 35px;
        }
        .information table tr h3 small{
            font-size: 15px;
        }
        .details{
            margin: auto;
            width: 50%;
            padding: 10px;
        }
    </style>

</head>
<body>
    <div class="information">
        <table >
            <tr>
                <h3>Educare Coaching Center <br>
                    <small>19/c Shaheb Ali Road Notun Bazar Mymensingh</small>
                </h3>
            </tr>
        </table>
    </div>
<br/>

<div class="admission">
    <h3>Admission Form</h3>
    <div class="details">
        <p>Student Id: <span style="text-decoration: underline " >{{$student}}</span></p>
            <p>Class : <span style="text-decoration: underline ;">{{$class->name}}</span>
                Batch :<span style="text-decoration: underline ;">{{$batch->name}}</span></p>
        <p>Name: <span style="text-decoration: underline " >{{$request->name}}</span></p>
        <p>Gender: <span style="text-decoration: underline ;">{{$request->gender}}</span></p>
        <p>Date Of Buth: <span style="text-decoration: underline ;">{{$request->dob}}</span></p>
        <p>Father Name: <span style="text-decoration: underline" >{{$request->father_name}}</span></p>
        <p>Mother Name: <span style="text-decoration: underline" >{{$request->mother_name}}</span></p>
        <p>Father Occupation: <span style="text-decoration: underline" >{{$request->father_occupation}}</span></p>
        <p>Parent Contact Number: <span style="text-decoration: underline ;">{{$request->parent_contact_number}}</span></p>
        <p>Emergency Contact Number: <span style="text-decoration: underline ;">{{$request->emergency_contact_number}}</span></p>
        <p>Current Institute: <span style="text-decoration: underline ;">{{$request->institute}}</span></p>
        <p>Mobile Number: <span style="text-decoration: underline ;">{{$request->mobile_number}}</span></p>
        <p>Email Address: <span style="text-decoration: underline ;">{{$request->email}}</span></p>
        <p>Division: <span style="text-decoration: underline ;">{{$division->name}}</span></p>
        <p>District: <span style="text-decoration: underline ;">{{$district->name}}</span></p>
        <p>Present Address: <span style="text-decoration: underline ;">{{$request->present_address}}</span></p>
        <p>Permanent Address: <span style="text-decoration: underline ;">{{$request->permanent_address}}</span></p>

    </div>


</div>

</body>
</html>