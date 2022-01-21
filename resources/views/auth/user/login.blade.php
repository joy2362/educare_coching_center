<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('asset/img/icons/icon_48x48.png')}}"/>
    <title>Login | ECC</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    body{
        background-image: url("asset/img/icons/bg.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    #particles-js{
        width: 100%;
        height: 100%;
    }
    .logo{
        width: 125px;
        height:  125px;
    }
</style>
</head>

<body>
<div id="particles-js">
    <main class="d-flex w-100" style="position: absolute;">
        <div class="container d-flex flex-column" >
            <div class="row vh-100">
                <div class="col-sm-8 col-md-6 col-lg-4 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-center mt-2">
                                    <img src="{{asset('asset/img/icons/logo.png')}}" class="logo" alt="logo">
                                    <p class="lead">
                                        Sign in to your account to continue
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-sm-4 ml-sm-4 mr-sm-4">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username"  class="form-label">User Name</label>
                                            <input class="form-control form-control-lg @error('username') is-invalid @enderror " id="username" type="text" name="username" placeholder="Enter your Username"  value="{{ old('username') }}"  autofocus />

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"  type="password" name="password" placeholder="Enter your password" />
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <small>
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                            </small>
                                        </div>
                                        <div class="float-right mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


@include('layout.partials.script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
        @endif
    });

</script>

</body>

</html>
