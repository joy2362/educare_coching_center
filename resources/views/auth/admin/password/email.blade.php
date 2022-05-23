<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('backend/img/icons/icon-48x48.png')}}" />

    <title>Forgot-password</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Reset Password</h1>
                        <p class="lead">
                            You Can reset your password here
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form method="POST" action="{{ route('admin.password.email') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email"  class="form-label">Email</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror " id="email" type="text" name="email" placeholder="Enter your Email"  value="{{ old('email') }}"  autofocus />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Proceed</button>
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

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{asset('asset/js/app.js')}}"></script>
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
