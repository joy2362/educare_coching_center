<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <h4 class="sidebar-brand" >
            <span class="align-middle">Educare </span>
        </h4>

        <ul class="sidebar-nav">
            <li class="sidebar-item active">
                <a class="sidebar-link" href=" {{ route('admin.home') }}  ">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-header">
                Student
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" href=" {{ route('admin.student.create') }}  ">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Admission</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
