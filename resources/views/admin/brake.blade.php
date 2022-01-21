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
        @import url(http://fonts.googleapis.com/css?family=Roboto);
        *
        {
            font-family: 'Roboto' , sans-serif;
        }

        body
        {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);
        }
        .error-template
        {
            padding: 40px 15px;
            text-align: center;
        }
        .error-actions
        {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .error-actions .btn
        {
            margin-right: 10px;
        }
        .message-box h1
        {
            color: #252932;
            font-size: 98px;
            font-weight: 700;
            line-height: 98px;
            text-shadow: rgba(61, 61, 61, 0.3) 1px 1px, rgba(61, 61, 61, 0.2) 2px 2px, rgba(61, 61, 61, 0.3) 3px 3px;
        }
    </style>
</head>

<body>
<div class="d-flex justify-content-center">
    <div class="row">
        <div class="col-md">
            <div class="error-template">
                <h2>
                    Temporarily down for maintenance
                </h2>
                <h1>
                    We’ll be back soon!
                </h1>
                <div>
                    <p>
                        Sorry for the inconvenience but we’re performing some maintenance at the moment.
                        we’ll be back online shortly!</p>
                    <p>
                        — Abdullah Zahid <small> (Developer)</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.partials.script')
</body>

</html>
