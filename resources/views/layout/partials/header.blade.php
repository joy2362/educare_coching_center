<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')

<link rel="shortcut icon" href="{{asset('asset/img/icons/icon_48x48.png')}}"/>
@yield('title')

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

<link href="{{ asset('asset/css/app.css') }}" rel="stylesheet">


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    .dataTables_paginate .previous {
        color: #6c757d;
        font-size: 18px;
        text-decoration: none;
        margin: 4px;
    }
    .dataTables_paginate span a {
        color: #6c757d;
        font-size: 18px;
        text-decoration: none;
        margin: 4px;
    }
    .dataTables_paginate  .next{
        color: #6c757d;
        font-size: 18px;
        text-decoration: none;
        margin: 4px;
    }
</style>
