<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="{{ asset('assets/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Blog Post System</span>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}
        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        @if (Auth::user()->role == 'admin')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('userdash') }}" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>

                    </li>


                    <li class="nav-item">
                        <a href="{{ route('listuser') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>

                            <p>
                                Users

                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listblog') }}" class="nav-link">
                            <i class="nav-icon fas fa-blog"></i>
                            <p>
                                Blogs

                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listcategory') }}" class="nav-link">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>
                                Categories

                            </p>
                        </a>

                    </li>


                </ul>
            </nav>
        @else
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('userdash') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('listblog') }}" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Blogs

                            </p>
                        </a>

                    </li>



                </ul>
            </nav>
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
