<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.partials.header')
    @yield('css')
</head>

<body>
    <div class="wrapper">
         <!-- sidebar start -->
        @if(Auth::guard('admin')->check())
            @include('layout.partials.admin.sidebar')
        @endif
        @if(Auth::guard('web')->check())
            @include('layout.partials.student.sidebar')
        @endif
        <!-- sidebar end -->
        <div class="main">
        <!-- top navbar start -->
        @if(Auth::guard('admin')->check())
            @include('layout.partials.admin.navbar')
        @endif
        @if(Auth::guard('web')->check())
            @include('layout.partials.student.navbar')
        @endif
        <!-- top navbar end -->
        <!-- main conten start-0 -->
        @yield('content')
        <!-- main content end -->
        <!-- footer start-0 -->
        @include('layout.partials.footer')
        <!-- footer end- -->
        </div>
    </div>

    @include('layout.partials.script')
    @yield('script')

</body>
</html>
