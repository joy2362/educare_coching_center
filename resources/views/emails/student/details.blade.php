@component('mail::message')
# Welcome {{$name}}
<h2>Your Account Is Ready.Account Details</h2>

<h1 style="font-size: 20px">User Name: {{$details->username}}</h1>
<h1 style="font-size: 20px">Password: {{$password}}</h1>

<br>

Thanks,
{{ config('app.name') }}
@endcomponent
