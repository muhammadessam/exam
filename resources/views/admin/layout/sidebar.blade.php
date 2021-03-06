<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Test
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @foreach(\App\Models\Section::all() as $section)
                        <li class="nav-item">
                            <a href="{{route('admin.sections.show', $section)}}"
                               class="nav-link {{request()->routeIs('admin.sections.show', $section) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{$section['name']}}</p>
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a href="{{route('admin.test.students')}}" class="nav-link {{request()->routeIs('admin.test.students') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.settings.index')}}" class="nav-link {{request()->routeIs('admin.settings.*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.test.index')}}" class="nav-link {{request()->routeIs('admin.test.*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Test</p>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->