<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('home')}}">
            <span class="align-middle"><img src="{{asset('asset/img/icons/logo.png')}}" style="width: 40px;height: 40px" alt="logo"><span class="m-2">Educare</span>
</span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-item {{ request()->is('/')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('home') }}  ">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('exam-date')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('exam-date') }}  ">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Exam Date</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('exam-result')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('exam-result') }}  ">
                    <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Result</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
