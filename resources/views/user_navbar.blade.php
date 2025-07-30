<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description"
                content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords"
                content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>AMZ Trader</title>
        <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
                rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css"
                href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/unslider.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/weather-icons/climacons.min.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/meteocons/style.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/morris.css">
        <!-- END: Vendor CSS-->
        <link rel="stylesheet" type="text/css"
                href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/simple-line-icons/style.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/timeline.css">
        <!-- END: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/style.css">
        <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->



<body class="vertical-layout vertical-menu 2-columns content-left-sidebar chat-application  fixed-navbar"
        data-open="click" data-menu="vertical-menu" data-col="2-columns">

        <!-- BEGIN: Header-->
        <nav
                class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
                <div class="navbar-wrapper">
                        <div class="navbar-header">
                                <ul class="nav navbar-nav flex-row">
                                        <li class="nav-item mobile-menu d-md-none mr-auto"><a
                                                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                                                class="feather icon-menu font-large-1"></i></a></li>
                                        <li class="nav-item"><a class="navbar-brand" href="#"><img class="brand-logo"
                                                                alt="stack admin logo"
                                                                src="../../../app-assets/images/logo/stack-logo.png">
                                                        <h5 class="brand-text">AMZ Trader</h5>
                                                </a></li>
                                        <li class="nav-item d-md-none"><a class="nav-link open-navbar-container"
                                                        data-toggle="collapse" data-target="#navbar-mobile"><i
                                                                class="fa fa-ellipsis-v"></i></a></li>
                                </ul>
                        </div>
                        <div class="navbar-container content">
                                <div class="collapse navbar-collapse" id="navbar-mobile">
                                        <ul class="nav navbar-nav mr-auto float-left">
                                                <li class="nav-item d-none d-md-block"><a
                                                                class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                                href="#"><i class="feather icon-menu"></i></a></li>

                                                <li class="nav-item d-none d-md-block"><a
                                                                class="nav-link nav-link-expand" href="#"><i
                                                                        class="ficon feather icon-maximize"></i></a>
                                                </li>

                                        </ul>
                                        <ul class="nav navbar-nav float-right">

                                                <li class="dropdown dropdown-user nav-item"><a
                                                                class="dropdown-toggle nav-link dropdown-user-link"
                                                                href="#" data-toggle="dropdown">
                                                                <div class="avatar avatar-online"><img
                                                                                src="https://eu.ui-avatars.com/api/?name={{Auth::user()->name}}&background=random"
                                                                                alt="avatar"><i></i></div><span
                                                                        class="user-name">{{Auth::user()->name}}</span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                                        <i class="feather icon-power"></i> Logout
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}"
                                                                        method="POST" class="d-none">
                                                                        @csrf
                                                                </form>
                                                        </div>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </div>
        </nav>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
                <div class="main-menu-content">
                        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                                <li class=" navigation-header"><span>General</span><i class=" feather icon-minus"
                                                data-toggle="tooltip" data-placement="right"
                                                data-original-title="General"></i>
                                </li>
                                <li class=" nav-item @if(\Request::is('user.index')) active @endif"><a
                                                href="{{route('user.index')}}"><i class="feather icon-home"></i><span
                                                        class="menu-title" data-i18n="Dashboard">Dashboard</span></a>

                                </li>

                                <li class=" nav-item"><a href="#"><i class="feather icon-book-open"></i><span
                                                        class="menu-title" data-i18n="Templates">Vendors</span></a>
                                        <ul class="menu-content">
                                                <li class="@if(\Request::is('showvendors')) active @endif"><a
                                                                class="menu-item" href="/showvendors"
                                                                data-i18n="1 columns">Manage Vendors</a>
                                                </li>
                                                <li class="@if(\Request::is('receivablevendors')) active @endif"><a
                                                                class="menu-item" href="/receivablevendors"
                                                                data-i18n="1 columns">Receivable Vendors</a>
                                                </li>

                                        </ul>
                                </li>




                                <li class=" nav-item"><a href="#"><i class="feather icon-tv"></i><span
                                                        class="menu-title" data-i18n="Templates">Make
                                                        Sale</span></a>
                                        <ul class="menu-content">

                                                <li class="@if (\Request::is('pos')) active @endif"><a class="menu-item"
                                                                href="/pos" data-i18n="1 columns">POS</a>
                                                </li>
                                                <li class="@if (\Request::is('sales/pending')) active @endif"><a class="menu-item"
                                                                href="/sales/pending" data-i18n="1 columns">Pending Sales</a>
                                                </li>
                                                <li class="@if (\Request::is('sales/approved')) active @endif"><a class="menu-item"
                                                                href="/sales/approved" data-i18n="1 columns">Approved Sales</a>
                                                </li>
                                                <li class="@if (\Request::is('sales/all')) active @endif"><a class="menu-item"
                                                                href="/sales/all" data-i18n="1 columns">All Sales</a>
                                                </li>
                                                <li class="@if (\Request::is('sales/refunds')) active @endif"><a class="menu-item"
                                                                href="/sales/refunds" data-i18n="1 columns">Refund</a>
                                                </li>

                                        </ul>
                                </li>
                                <li class=" nav-item"><a href="#"><i class="feather icon-tv"></i><span
                                                        class="menu-title" data-i18n="Templates">Accessory
                                                        Inventory</span></a>
                                        <ul class="menu-content">
                                                <li class="@if (\Request::is('accessories')) active @endif"><a
                                                                class="menu-item" href="/accessories"
                                                                data-i18n="1 columns">Add Accessory</a>
                                                </li>
                                                <li class="@if (\Request::is('batches')) active @endif"><a
                                                                class="menu-item" href="/batches"
                                                                data-i18n="1 columns">Add Batch</a>
                                                </li>


                                        </ul>
                                </li>
                                <li class=" nav-item"><a href="#"><i class="feather icon-tv"></i><span
                                                        class="menu-title" data-i18n="Templates">Add values</span></a>
                                        <ul class="menu-content">
                                                <li class="@if (\Request::is('showcompanies')) active @endif"><a
                                                                class="menu-item" href="/showcompanies"
                                                                data-i18n="1 columns">Companies</a>
                                                </li>
                                                <li class="@if (\Request::is('showgroups')) active @endif"><a
                                                                class="menu-item" href="/showgroups"
                                                                data-i18n="1 columns">Groups</a>
                                                </li>

                                        </ul>
                                </li>
                                @php
                                $userId = auth()->id();
                                @endphp

                                @if (in_array($userId, [1, 2]))
                                <li class="nav-item">
                                        <a href="#"><i class="feather icon-tv"></i>
                                                <span class="menu-title" data-i18n="Templates">Settings</span>
                                        </a>
                                        <ul class="menu-content">
                                                <li class="@if (\Request::is('accessoryreport')) active @endif"><a
                                                                class="menu-item" href="/accessoryreport"
                                                                data-i18n="1 columns">Report</a>
                                                </li>
                                                <li class="@if (\Request::is('showpassword')) active @endif">
                                                        <a class="menu-item" href="/showpassword"
                                                                data-i18n="1 columns">Password</a>
                                                </li>
                                                <li class="@if (\Request::is('showlogin')) active @endif">
                                                        <a class="menu-item" href="/showlogin" data-i18n="1 columns">Set
                                                                login Time</a>
                                                </li>
                                                <li class="@if (\Request::is('showusers')) active @endif">
                                                        <a class="menu-item" href="/showusers"
                                                                data-i18n="1 columns">Manage Users</a>
                                                </li>
                                                <li
                                                        class="@if (\Request::is('send-message-to-customers')) active @endif">
                                                        <a class="menu-item" href="/send-message-to-customers"
                                                                data-i18n="1 columns">Send Message</a>
                                                </li>
                                                <li
                                                        class="@if (\Request::is('loginhistory')) active @endif">
                                                        <a class="menu-item" href="/loginhistory"
                                                                data-i18n="1 columns">Login Histories</a>
                                                </li>
                                        </ul>
                                </li>
                                @endif





                        </ul>
                </div>
        </div>

        @yield('content')

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-dark navbar-border">
                <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2023 <a
                                        class="text-bold-800 grey darken-2"
                                        href="https://www.linkedin.com/in/syed-shehryar-46a21a1b3/"
                                        target="_blank">Sherry </a></span><span
                                class="float-md-right d-none d-lg-block">Hand-crafted & Made
                                with <i class="feather icon-heart pink"></i></span></p>
        </footer>
        <!-- END: Footer-->


        <!-- BEGIN: Vendor JS-->
        <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
        <!-- BEGIN Vendor JS-->
        <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
        <script src="../../../app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
        <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
        <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
        <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
        <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
        <!-- BEGIN: Page Vendor JS-->
        <script src="../../../app-assets/vendors/js/extensions/unslider-min.js"></script>
        <script src="../../../app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
        <!-- END: Page Vendor JS-->
        <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
        <!-- BEGIN: Theme JS-->
        <script src="../../../app-assets/js/core/app-menu.js"></script>
        <script src="../../../app-assets/js/core/app.js"></script>
        <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
        <!-- END: Theme JS-->
        <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
        <!-- BEGIN: Page JS-->
        <script src="../../../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
        <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
        <!-- END: Page JS-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
<!-- END: Body-->

</html>