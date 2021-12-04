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
                Class
            </li>
            <li class="sidebar-item {{ request()->is('admin/class*') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.class.index') }}  ">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Class</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/section') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.section.index') }}  ">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Section</span>
                </a>
            </li>
            <li class="sidebar-header">
                Routin
            </li>
            <li class="sidebar-item {{ request()->is('admin/section') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.section.index') }}  ">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Section</span>
                </a>
            </li>
            <li class="sidebar-header">
                Student
            </li>
            <li class="sidebar-item {{ request()->is('admin/student/*') ? 'active' :'' }}">
                <a class="sidebar-link" href=" {{ route('admin.student.create') }}  ">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Admission</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
