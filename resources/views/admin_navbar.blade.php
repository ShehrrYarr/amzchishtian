<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Adora LLC</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

     <!-- BEGIN: Vendor CSS-->
     <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/morris.css">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html"><img class="brand-logo" alt="stack admin logo" src="../../../app-assets/images/logo/stack-logo.png">
                            <h2 class="brand-text">Adora LLC</h2>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu"></i></a></li>

                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>

                    </ul>
                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="avatar avatar-online"><img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->name}}&background=random" alt="avatar"><i></i></div><span class="user-name">{{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="user-profile.html"><i class="feather icon-user"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a><a class="dropdown-item" href="user-cards.html"><i class="feather icon-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="feather icon-power"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                <li class=" navigation-header"><span>General</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class=" nav-item @if(\Request::is('home')) active @endif"><a href="{{route('home')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>

                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-book-open"></i><span class="menu-title" data-i18n="Templates">Publications</span></a>
                    <ul class="menu-content">
                        <li class="@if(\Request::is('publication')) active @endif"><a class="menu-item" href="{{route('publication')}}" data-i18n="1 column">Create</a>
                        </li>
                        <li class="@if(\Request::is('managepublication')) active @endif"><a class="menu-item" href="{{route('managepublication')}}" data-i18n="2 columns">Manage</a>
                        </li>
                        <li class="@if(\Request::is('publicationallocation')) active @endif"><a class="menu-item" href="{{route('publicationallocation')}}" data-i18n="2 columns">Publication Allocation</a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-tv"></i><span class="menu-title" data-i18n="Templates">Media</span></a>
                    <ul class="menu-content">
                        <li class="@if(\Request::is('createmedia')) active @endif"><a class="menu-item" href="{{route('createmedia')}}" data-i18n="1 column">Manage Media</a>
                        </li>
                        <li class="@if(\Request::is('mediacategory')) active @endif"><a class="menu-item" href="{{route('mediacategory')}}" data-i18n="2 column">Manage Category</a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-tag"></i><span class="menu-title" data-i18n="Templates">Citation</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="../../../starter-kit/ltr/vertical-menu-template/layout-1-column.html" data-i18n="1 column">Create</a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/ltr/vertical-menu-template/layout-2-columns.html" data-i18n="2 columns">Manage</a>
                        </li>
                    </ul>
                </li>

                <li class=" navigation-header"><span>Users & Payments</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Components"></i>
                </li>
                <li class=" nav-item"><a href="app-contacts.html"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Contacts">Payments</span></a>
                </li>
                <li class=" nav-item"><a href="project-summary.html"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Project Summary">Users</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('adminthread')}}"><i class="feather icon-message-square"></i><span class="menu-title" data-i18n="Chat Application">Chat Application</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- yeild view/content here -->
    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2023 <a class="text-bold-800 grey darken-2" href="http://ainigmadev.com" target="_blank">Ainigma Dev </a></span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with <i class="feather icon-heart pink"></i></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    {{-- <script src="../../../app-assets/vendors/js/vendors.min.js"></script> --}}
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

</body>
<!-- END: Body-->

</html>
