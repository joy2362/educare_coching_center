<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <h4 class="sidebar-brand" >
            <span class="align-middle">Educare</span>
        </h4>
        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->is('admin/home') ? 'active' : '' }}">
                <a class="sidebar-link" href=" {{ route('admin.home') }}  ">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-header">
                Academic
            </li>
            <li class="sidebar-item {{ request()->is('admin/class*')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.class.index') }}  ">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Class</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/routine*')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.routine.index') }}  ">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Routine</span>
                </a>
            </li>


            <li class="sidebar-header">
                Student
            </li>
            <li class="sidebar-item {{ request()->is('admin/student/create')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.student.create') }}  ">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Admission</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/student') && !request()->is('admin/student/create') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.student.index') }}  ">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Student</span>
                </a>
            </li>

            <li class="sidebar-header">
                Account
            </li>
            <li class="sidebar-item {{ request()->is('admin/student-account/create')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.student-account.create') }}  ">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Make Payment </span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/student-account')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.student-account.index') }}  ">
                    <i class="align-middle" data-feather="smile"></i> <span class="align-middle">Payment History</span>
                </a>
            </li>

            <li class="sidebar-header">
                Notice
            </li>
            <li class="sidebar-item {{ request()->is('admin/notice/student')  ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.notice.student') }}  ">
                    <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Notice</span>
                </a>
            </li>

            <li class="sidebar-header">
                Exam
            </li>
            <li class="sidebar-item {{ request()->is('admin/exam*') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.exam.index') }}  ">
                    <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Exam Date</span>
                </a>
            </li>

            <li class="sidebar-header">
                Activity
            </li>
            <li class="sidebar-item {{ request()->is('admin.activity-log.index*') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.activity-log.index') }}  ">
                    <i class="align-middle" data-feather="gift"></i> <span class="align-middle">Activity-log</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
