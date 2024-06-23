<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | @lang('back.AppName')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('acp/images/favicon.ico') }}">
    @yield('css')
    <!-- Bootstrap Css -->
    <link href="{{ url('acp/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('acp/css/icons.min.css?v=1.2') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('acp/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap" rel="stylesheet">

    <style>
        .custom-color {
            color: #5b73e8 !important;
        }
    </style>
</head>



<body data-sidebar="colored">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('home') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ url('acp/images/avatar-9.jpeg') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('acp/images/logo-dark.png') }}" alt="" height="20">
                            </span>
                        </a>

                        <a href="{{ route('home') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ url('acp/images/avatar-9.jpeg') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('acp/images/logo-light.png') }}" alt="" height="20">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="uil-search"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ url('acp/images/users/avatar-10.jpeg') }}" alt="Header Avatar">
                            <span
                                class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Auth::user()->name }}</span>
                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{--  <a class="dropdown-item" href="#"><i
                                class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                                class="align-middle">View Profile</span></a>
                        <a class="dropdown-item" href="#"><i
                                class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span
                                class="align-middle">My Wallet</span></a>
                        <a class="dropdown-item d-block" href="#"><i
                                class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span
                                class="align-middle">Settings</span> <span
                                class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a>
                        --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i
                                    class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                                    class="align-middle">@lang('back.logout')</span></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    {{--  <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="uil-cog"></i>
                    </button>
                </div> --}}

                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ getSetting('logo')->value }}" alt="" style="width: 40%" class="">
                        {{--                    {{getSetting('name')->value}} --}}
                        {{--                            <img src="{{url('acp/images/avatar-9.jpeg')}}" alt="" height="22"> --}}
                    </span>
                    <span class="logo-lg">
                        {{--                    {{getSetting('name')->value}} --}}
                        <img src="{{ getSetting('logo')->value }}" alt="" style="width: 40%" class="">

                        {{--                            <img src="{{url('acp/images/logo-dark.png')}}" alt="" height="20"> --}}
                    </span>
                </a>

                <a href="{{ route('home') }}" class="logo logo-light" style="color:#fff">
                    <span class="logo-sm">
                        {{--                        <img src="{{getSetting('logo')->value}}" alt="" style="width: 40%"  class=""> --}}
                        {{ getSetting('name')->value }}

                        {{--                            <img src="{{url('acp/images/avatar-9.jpeg')}}" alt="" height="22"> --}}
                    </span>
                    <span class="logo-lg">
                        {{--                        <img src="{{getSetting('logo')->value}}" alt="" style="width: 40%"  class=""> --}}
                        {{ getSetting('name')->value }}
                        {{--                            <img src="{{url('acp/images/logo-light.png')}}" alt="" height="20"> --}}
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div data-simplebar class="sidebar-menu-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="uil-home-alt"></i>
                                <span>@lang('back.dashborad')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('printing_models.index') }}">
                                <i class="uil-print"></i>
                                <span>@lang('back.printing_models')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.billing_movements')</li>
                        <li>
                            <a href="{{ route('sales.index') }}">
                                <i class="uil-shopping-cart-alt"></i>
                                <span>@lang('back.sales')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('purchases.index') }}">
                                <i class="uil-calendar-alt"></i>
                                <span>@lang('back.purchases')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.external_debt') }}">
                                <i class="uil-money-withdrawal"></i>
                                <span>@lang('back.external_debt')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transfers.index') }}">
                                <i class="uil-exchange-alt"></i>
                                <span>@lang('back.transfers_store')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudan_sales.index') }}">
                                <i class="uil-money-withdrawal"></i>
                                <span>@lang('back.sudan_sales')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.menu')</li>
                        <li>
                            <a href="{{ route('report.store') }}">
                                <i class="uil-calendar-alt"></i>
                                <span>@lang('back.report_store')</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('trakings.index', 'custody') }}">
                                <i class="fas fa-route"></i>
                                <span>@lang('back.trakings') @lang('back.custody_traking')</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('trakings.index', 'sales') }}">
                                <i class="fas fa-route"></i>
                                <span>@lang('back.trakings') @lang('back.sales')</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('trakings.index', 'freezers') }}">
                                <i class="fas fa-route"></i>
                                <span>@lang('back.trakings') @lang('back.freezer_transfare')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.HR')</li>
                        <li>
                            <a href="{{ route('categories.index') }}">
                                <i class="uil-sitemap"></i>
                                <span>@lang('back.categories')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('employees.index') }}">
                                <i class="uil-users-alt"></i>
                                <span>@lang('back.employees')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index') }}">
                                <i class="uil-bag-alt"></i>
                                <span>@lang('back.jobs')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('attendants.index', 'driver') }}">
                                <i class="uil-clock-seven"></i>
                                <span>@lang('back.attendants') @lang('back.drivers')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('attendants.index', 'mangers') }}">
                                <i class="uil-clock-seven"></i>
                                <span>@lang('back.attendants') @lang('back.mangers')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.STORE')</li>
                        <li>
                            <a href="{{ route('stores.index') }}">
                                <i class="uil-store-alt"></i>
                                <span>@lang('back.stores')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}">
                                <i class="uil-water-glass"></i>
                                <span>@lang('back.products')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('units.index') }}">
                                <i class="uil-sitemap"></i>
                                <span>@lang('back.units')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('brands.index') }}">
                                <i class="uil-copyright"></i>
                                <span>@lang('back.brands')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('providers.index') }}">
                                <i class="uil-users-alt"></i>
                                <span>@lang('back.providers')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('clients.index') }}">
                                <i class="uil-user"></i>
                                <span>@lang('back.clients')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.CARS')</li>
                        <li>
                            <a href="{{ route('vehicles.index') }}">
                                <i class="uil-car-wash"></i>
                                <span>@lang('back.vehicles')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('maintenances.index') }}">
                                <i class="uil-cog"></i>
                                <span>@lang('back.periodic_maintenance')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.FollowUp')</li>
                        <li>
                            <a href="{{ route('bookings.index') }}">
                                <i class="uil-calendar-alt"></i>
                                <span>@lang('back.bookings')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('booking.freezers.index') }}">
                                <i class="uil-snowflake-alt"></i>
                                <span>@lang('back.bookings_freezers')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('back.REPORTS')</li>
                        <li>
                            <a href="{{ route('report.store') }}">
                                <i class="uil-calendar-alt"></i>
                                <span>@lang('back.report_store')</span>
                            </a>
                        </li>
                        {{--

                    <li class="menu-title">@lang('back.REPORTS')</li>

                    <li>
                        <a href="{{route('tree')}}"><span><i class="uil-10-plus"></i>@lang('back.tree_accounting')</span></a>
                    </li>
                    <li>
                        <a href="{{route('accounts.index')}}"><i class="uil-10-plus"></i><span>@lang('back.accounts')</span></a>
                    </li>
                    <li>
                        <a href="{{route('catch_receipts.index')}}"><i class="uil-10-plus"></i><span>@lang('back.catch_receipts')</span></a>
                    </li>
                    <li>
                        <a href="{{route('receipts.index')}}"><i class="uil-10-plus"></i><span>@lang('back.receipts')</span></a>
                    </li>
                    <li>
                        <a href="{{route('dailymoves.index')}}"><i class="uil-10-plus"></i><span>@lang('back.dailymoves')</span></a>
                    </li>
                    <li>
                        <a href="{{route('customers_balances')}}"><span><i class="uil-10-plus"></i>@lang('back.customers_balances')</span></a>
                    </li>
                    --}}
                        {{-- <li>
                        <a class="dropdown-item" href="{{route('expenses.index')}}">@lang('back.expenses')</a>
                    </li> --}}{{--


                    <li>
                        <a href="{{route('payments.index')}}"><i class="uil-10-plus"></i><span>@lang('back.payment_method')</span></a>
                    </li>
                    <li>
                        <a href="{{route('accounting.setting','accounting')}}"><i class="uil-10-plus"></i><span>@lang('back.accounting_setting')</span></a>
                    </li>
                    <li>
                        <a href="{{route('financial.center')}}"><i class="uil-10-plus"></i><span>@lang('back.financial_center')</span></a>
                    </li>
--}}

                        <li class="menu-title">@lang('back.settings')</li>
                        <li>
                            <a href="{{ route('setting_km.create') }}">
                                <i class="fas fa-route"></i>
                                <span>@lang('back.settings') @lang('back.pricing') </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.create') }}">
                                <i class="uil-cog"></i>
                                <span> @lang('back.settings') @lang('back.general')</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">


                    @yield('content')


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            © {{ getSetting('name')->value }}.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by <a
                                    href="https://h-mokhtar.com/" class="text-reset">Hossam Mokhtar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    {{--

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">

        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>


        <!-- Settings -->
        <hr class="mt-0"/>
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked/>
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"/>
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch"/>
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

--}}
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ url('acp/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('acp/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('acp/libs/metismenu/metisMenu.min.js') }}"></script>


    @yield('js')
    <script src="{{ url('acp/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('acp/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('acp/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('acp/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <!-- App js -->
    <script src="{{ url('acp/js/app.js') }}"></script>

    <style>
        .select2-selection,
        .select2-results__option {
            text-align: right;
        }
    </style>

</body>

</html>
