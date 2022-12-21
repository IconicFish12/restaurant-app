<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="vanushki admin dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="ibnu">
    <link rel="shortcut icon" href="{{ asset('/img/favico.png') }}" type="image/x-icon">

    <title>{{ $title ?? "Vanushki Restaurant" }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ asset('/administrator') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('/img/Vanushki (2).png') }}" width="100">
                </div>
                <div class="sidebar-brand-text">Vanushki Restaurant</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ asset('/administrator') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            @if (auth()->guard('web')->check())
            <div class="sidebar-heading">
                Restaurant Module
            </div>
            @else
            <div class="sidebar-heading">
                Employee Module
            </div>
            @endif

            <!-- Nav Item - Pages Collapse Menu -->
            @auth('web')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuOne"
                    aria-expanded="true" aria-controls="menuOne">
                    <i class="fas fa-store"></i>
                    <span>Restaurant Core</span>
                </a>
                <div id="menuOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menus Component</h6>
                        <a class="collapse-item" href="{{ asset('administrator/menus') }}">
                            <i class="fas fa-utensils"></i>
                            <span>Restaurant Menu</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/categories') }}">
                            <i class="fas fa-th-large"></i>
                            <span>Menu Category</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/tables') }}">
                            <i class="fas fa-table"></i>
                            <span>Restaurant Tables</span>
                        </a>
                    </div>
                </div>
            </li>
            @endauth


            {{-- <!-- Nav Item - Utilities Collapse Menu --> --}}
            @auth('web')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuTwo"
                    aria-expanded="true" aria-controls="menuTwo">
                    <i class="fas fa-users"></i>
                    <span>Management</span>
                </a>
                <div id="menuTwo" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Management</h6>
                        <a class="collapse-item" href="{{ asset('administrator/users') }}">
                            <i class="fas fa-user"></i>
                            <span>Users</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/employees') }}">
                            <i class="fas fa-user-tie"></i>
                            <span>Employees</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuThree"
                    aria-expanded="true" aria-controls="menuThree">
                    <i class="fas fa-layer-group"></i>
                    <span>Transaction activity</span>
                </a>
                <div id="menuThree" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction Component</h6>
                        <a class="collapse-item" href="{{ asset('administrator/orders') }}">
                            <i class="fas fa-box-open"></i>
                            <span>Order</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/histories') }}">
                            <i class="fas fa-history"></i>
                            <span>History</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/vouchers') }}">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Voucher</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuFour"
                    aria-expanded="true" aria-controls="menuFour">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Payment Management</span>
                </a>
                <div id="menuFour" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Payment Component</h6>
                        <a class="collapse-item" href="{{ asset('administrator/payment-methods') }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Payment Method</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/e-payments') }}">
                            <i class="fas fa-money-check-alt"></i>
                            <span>E-Money</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/bank-payments') }}">
                            <i class="fas fa-wallet"></i>
                            <span>Bank Transaction</span>
                        </a>
                    </div>
                </div>
            </li>
            @endauth

            {{-- <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            @auth('web')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuFive"
                    aria-expanded="true" aria-controls="menuFive">
                    <i class="fas fa-headset"></i>
                    <span>Contact Service</span>
                </a>
                <div id="menuFive" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Contact Service:</h6>
                        <a class="collapse-item" href="{{ asset('administrator/messages') }}">
                            <i class="fas fa-bell"></i>
                            <span >Message</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/replies') }}l">
                            <i class="fas fa-reply-all"></i>
                            <span>Replies</span>
                        </a>
                    </div>
                </div>
            </li>
            @endauth

            <!-- Nav Item - Employee -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuSix"
                    aria-expanded="true" aria-controls="menuSix">
                    <i class="fas fa-users-cog"></i>
                    <span>Employee Performance</span>
                </a>
                <div id="menuSix" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Performance Management:</h6>
                        <a class="collapse-item" href="{{ asset('administrator/works') }}">
                            <i class="fas fa-tasks"></i>
                            <span >Work Todo</span>
                        </a>
                        <a class="collapse-item" href="{{ asset('administrator/performances') }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Performance</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('administrator/attendances-data') }}">
                    <i class="fas fa-user-clock"></i>
                    <span>Attendance</span>
                </a>
            </li>

            {{-- Nav Item - Database Backup --}}
            @auth('web')
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('administrator/backup') }}">
                    <i class="fas fa-database"></i>
                    <span>Database Backup</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ asset('administrator/documentation') }}">
                    <i class="fas fa-book"></i>
                    <span>Documentation</span>
                </a>
            </li>
            @endauth

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            {{-- <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> --}}

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h3 class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 text-danger">
                        {{ $page_name ?? "Vanushki Restaurant" }}
                    </h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username ?? Auth::guard('employee')->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (auth('web'))
                                    <a class="dropdown-item" href=" {{ asset('administrator/me') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div>
                    @yield('container')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Vanushki Restaurant 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{ asset('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

     <!-- javascripy bootstarp -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
     </script>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    {{-- AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    {{-- Script to get data --}}
    @yield('script')

    @include('sweetalert::alert')


</body>

</html>
