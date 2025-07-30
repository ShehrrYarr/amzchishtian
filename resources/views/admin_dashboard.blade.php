@extends('admin_navbar')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Grouped multiple cards for statistics starts here -->
                <div class="row grouped-multiple-statistics-card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-book-open customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600">{{$totalPublications}}</h3>
                                                <p class="sub-heading">Publications</p>
                                            </div>
                                            <!-- <span class="inc-dec-percentage">
                                                <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                            </span> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon danger d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-camera customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600">3</h3>
                                                <p class="sub-heading">Media</p>
                                            </div>
                                            <!-- <span class="inc-dec-percentage">
                                                <small class="danger"><i class="fa fa-long-arrow-down"></i> 2.0%</small>
                                            </span> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon success d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-bubble customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600">6</h3>
                                                <p class="sub-heading">Citations</p>
                                            </div>
                                            <!-- <span class="inc-dec-percentage">
                                                <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                            </span> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start">
                                            <span class="card-icon warning d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-basket-loaded customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600">4</h3>
                                                <p class="sub-heading">Orders</p>
                                            </div>
                                            <!-- <span class="inc-dec-percentage">
                                                <small class="danger"><i class="fa fa-long-arrow-down"></i> 13.6%</small>
                                            </span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grouped multiple cards for statistics ends here -->

                <!-- Minimal modern charts for power consumption, region statistics and sales etc. starts here -->
                <div class="row minimal-modern-charts">
                   

                    <!-- latest update tracking chart-->
                    <div class="col-xxl-4 col-xl-8 col-lg-8 col-md-12 col-12 latest-update-tracking">
                        <div class="card">
                            <div class="card-header latest-update-heading d-flex justify-content-between">
                                <h4 class="latest-update-heading-title text-bold-500">Latest Update</h4>
                                <!-- <div class="dropdown update-year-menu pb-1">
                                    <a class="bg-transparent dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">2019</a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">2018</a>
                                        <a class="dropdown-item" href="#">2017</a>
                                        <a class="dropdown-item" href="#">2016</a>
                                    </div>
                                </div> -->
                            </div>
                            <div class="card-content latest-update-tracking-list pt-0 pb-1 px-2 position-relative">
                                <ul class="list-group">
                                    <li class="list-group-item pt-0 px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i class="icon text-primary bg-light-primary icon-bag total-products-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Last Publication</p>
                                                <small class="font-small-3">Stem cells therapy</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">2 Customers</span>
                                    </li>
                                    <li class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i class="icon icon-bubble bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Recent Citation</p>
                                                <small class="font-small-3">Peter Parker participation</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">1 Customer</span>
                                    </li> 
                                    <li class="list-group-item px-0 latest-updated-item border-0 pb-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="list-group-item-icon d-inline mr-1">
                                                <i class="icon icon-camera bg-light-danger text-danger total-revenue-icon rounded-circle p-50"></i>
                                            </div>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Media</p>
                                                <small class="font-small-3">New York Times</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">7 Customers</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- info and time tracking chart -->
                    <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="card info-time-tracking">
                        <div id="audience-list-scroll" class="table-responsive position-relative">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Is Admin</th>
                                                <th>Paid</th>
                                                <th>More</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($totalUsers as $key)
                                                <tr>
                                                    <td class="text-truncate">
                                                        <div class="avatar avatar-md mr-1">
                                                            <img class="rounded-circle" src="https://eu.ui-avatars.com/api/?name={{$key->name}}&background=random" alt="Generic placeholder image">
                                                        </div>
                                                        <span class="text-truncate">{{$key->name}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>{{$key->email}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>{{$key->password_text}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>
                                                            @if($key->is_admin == 1)
                                                                <span class="badge badge-info">Yes</span>
                                                            @else
                                                                <span class="badge badge-danger">No</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-success">Yet to implement</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        @if($key->is_admin == 1)
                                                        @else
                                                            <div class="dropdown">
                                                                <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Block</a>
                                                                </div>
                                                            </div> 
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- Minimal modern charts for power consumption, region statistics and sales etc. starts here -->



                <!-- active users and my task timeline cards starts here -->
                <div class="row match-height">
                    
                    <!-- <div class="col-xl-8 col-lg-12">
                        <div class="card active-users">
                            <div class="card-header border-0">
                                <h4 class="card-title">Active Users</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                               
                            </div>
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive position-relative">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Is Admin</th>
                                                <th>Paid</th>
                                                <th>More</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($totalUsers as $key)
                                                <tr>
                                                    <td class="text-truncate">
                                                        <div class="avatar avatar-md mr-1">
                                                            <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png" alt="Generic placeholder image">
                                                        </div>
                                                        <span class="text-truncate">{{$key->name}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>{{$key->email}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>{{$key->password_text}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span>
                                                            @if($key->is_admin == 1)
                                                                <span class="badge badge-info">Yes</span>
                                                            @else
                                                                <span class="badge badge-danger">No</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-success">Yet to implement</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        @if($key->is_admin == 1)
                                                        @else
                                                            <div class="dropdown">
                                                                <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Block</a>
                                                                </div>
                                                            </div> 
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  -->
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">My Tasks</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="widget-timeline">
                                        <ul>
                                            <li class="timeline-items timeline-icon-success">
                                                <p class="timeline-time">Monday 12:12pm</p>
                                                <div class="timeline-title">Catch Up With Brain</div>
                                                <div class="timeline-subtitle">Mobile Project</div>
                                                <div>
                                                    <ul class="list-unstyled users-list cursor-pointer m-0 d-flex align-items-center">
                                                        <li class="avatar avatar-sm pull-up my-0">
                                                            <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-20.png" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="Ogasawara">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="timeline-items timeline-icon-danger">
                                                <p class="timeline-time">2 days ago</p>
                                                <div class="timeline-title">Make new icons</div>
                                                <div class="timeline-subtitle">Web Apps</div>
                                            </li>
                                            <li class="timeline-items timeline-icon-warning">
                                                <p class="timeline-time">Yesterday</p>
                                                <div class="timeline-title">
                                                    <span>Design explorations</span>
                                                    <span class="badge badge-pill badge-sm badge-success">Completed</span>
                                                </div>
                                                <div class="timeline-subtitle">Company Website</div>
                                            </li>
                                            <li class="timeline-items timeline-icon-info">
                                                <p class="timeline-time">5 hours ago</p>
                                                <div class="timeline-title">Lunch with Mary</div>
                                                <div class="timeline-subtitle">Grill House</div>
                                                <div>
                                                    <ul class="list-unstyled users-list cursor-pointer m-0 d-flex align-items-center">
                                                        <li class="avatar avatar-sm pull-up my-0">
                                                            <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-20.png" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="Ogasawara">
                                                        </li>
                                                        <li class="avatar avatar-sm pull-up my-0">
                                                            <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-21.png" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="Stepan">
                                                        </li>
                                                        <li class="avatar avatar-sm pull-up my-0">
                                                            <img class="rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-22.png" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="Kimberly">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection