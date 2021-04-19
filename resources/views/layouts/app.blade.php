<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">

    @if(\Request::segment(1) == 'admin')
        <title>DormDoctors Admin Panel</title>
    @else
        <title>DormDoctors Staff Panel</title>
    @endif

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- morris CSS -->
    <link href="{{asset('assets/plugins/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('assets/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .user-profile .dropdown-menu {
    left: 0px;
    right: 0px;
    top: 62px!important;
    width: 190px;
    margin: 0 auto;
}
.sidebar-nav>ul>li>a.active {
    font-weight: 400;
    background: white;
    color: #1976d2;;
}
.imagesmall{
    width:25px ;
}
.left-sidebar {
    position: absolute;
    width: 295px;
    height: 100%;
    top: 0px;
    z-index: 20;
    padding-top: 60px;
    background: #fff;
    -webkit-box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
    box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
}
/* @media (min-width: 768px) */
.navbar-header {
    width: 280px;
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}

ul.crm_menubtn{
        display: none;
    }
    ul.sidebar-item.crm_menubtn.in li.sidebar-item {
        background: #e8e8e8d6;
        margin-bottom: 0px !important;
        padding: 2px 2px;
        border-bottom: 1px solid #7b899857;
    }

    ul.sidebar-item.crm_menubtn.in li.sidebar-item a span.hide-menu {
        font-size: 14px !important;
        padding-left: 10px;
    }
    </style>


</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->

                            <img width="100" src="{{asset('images/logo.png')}}" id="imagee" alt="homepage" class="dark-logo" />

                            {{-- MenuBar Admin Panel --}}


                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         {{-- <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" /> --}}
                         <!-- Light Logo text -->
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a id="small" class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li> --}}
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i> English</a>

                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a>
                            </div>

                        </li>
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            @if(Auth::user()->type == 'ADMIN')
                                 <img src="{{Auth::user()->profile_image  }}" alt="user" width=25 />
                            @else
                                <img src="{{ asset('images/staff_members').'/'.Auth::user()->profile_image  }}" alt="user" width=25 />
                            @endif

                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                        @if(Auth::user()->type == 'ADMIN')
                                            <img src="{{ Auth::user()->profile_image  }}" alt="user" />
                                        @else
                                            <img src="{{ asset('images/staff_members').'/'.Auth::user()->profile_image  }}" alt="user" width=25 />
                                        @endif
                                            </div>
                                            <div class="u-text">
                                                @if(Auth::user()->type == 'ADMIN')
                                                <h4>{{ Auth::user()->first_name}}</h4>
                                                @else
                                                <h4>{{ Auth::user()->name}}</h4>
                                                @endif
                                                <p class="text-muted">{{ Auth::user()->email }}</p></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                <li><a href="@if(Auth::user()->type == 'ADMIN'){{route('profile.show')}}@else{{ route('staff.profile.show') }}@endif"><i class="ti-user"></i> My Profile </a></li>
                                    <li><a href="@if(Auth::user()->type == 'ADMIN'){{route('password.show')}}@else{{ route('staff.password.show') }}@endif"><i class="ti-user"></i> Change Password </a></li>

                                    <li><a href="@if(Auth::user()->type == 'ADMIN'){{ route('logout') }}@else{{ route('staff.logout') }}@endif"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                <div class="profile-img">
                    <!-- @if(Auth::user()->type == 'ADMIN')

                        <img src="{{ Auth::user()->profile_image}}" alt="user" />
                    @else
                        <img src="{{ asset('images/staff_members').'/'.Auth::user()->profile_image  }}" alt="user" />
                    @endif -->
                    <!-- this is blinking heartbit-->
                        {{-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> --}}
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <!-- @if(\Auth::user()->type == 'ADMIN' )
                            <h5>{{ Auth::user()->first_name  }}</h5>
                        @else
                            <h5>{{ Auth::user()->name  }}</h5>
                        @endif -->
                        {{-- <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a> --}}
                        {{-- <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a> --}}
                    @if(\Auth::user()->type == 'ADMIN' )
                    <a href="{{ route('logout') }}" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                    @else
                    <a href="{{ route('staff.logout') }}" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                    @endif
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> Change Password</a>
                            <!-- text-->
                            <!-- text-->
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->

             @if(\Auth::user()->type == 'ADMIN' )

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                         
                        <li @if(\Request::segment(2) == 'home')class="active" @endif> <a class=" waves-effect " href="{{route('home')}}" aria-expanded="false"><!-- <i class="mdi mdi-gauge"></i> --> <span class="icon"><i class="fas fa-tachometer-alt"></i></span> <span class="hide-menu">
                             Dashboard </span></a>
                        </li>

                        <li @if(\Request::segment(2) == 'orders')class="active" @endif > <a class=" waves-effect " href="{{route('orders.all')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-cash-register"></i></span><span class="hide-menu">New Orders <b class="noti">{{ $new_orders }}</b></span></a>
                        </li>

                        <li @if(\Request::segment(2) == 'users')class="active" @endif> <a class=" waves-effect " href="{{route('users.index')}}" aria-expanded="false"><!-- <i class="fa fa-users"></i> --><span class="icon"><i class="fas fa-users"></i></span><span class="hide-menu">My Customers</span></a>
                        </li>
                        <li @if(\Request::segment(2) == 'schedule')class="active" @endif > <a class=" waves-effect " href="{{route('scheduler.index')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-calendar-alt"></i></span><span class="hide-menu">Today’s Schedule <b class="noti">{{ $today_schedule }}</b></span></a>
                        </li> 

                        <li @if(\Request::segment(2) == 'laundrylogs')class="active" @endif > <a class=" waves-effect " href="{{route('laundrylogs.index')}}" aria-expanded="false"><span class="icon"><i class="fas fa-clipboard-list"></i></span><!-- <i class="fa fa-dollar"></i> --><span class="hide-menu">Intake Log </span></a>
                        </li>

                        <li @if(\Request::segment(2) == '/overweight-index')class="active" @endif > <a class=" waves-effect " href="{{route('laundrylogs.overweightindex')}}" aria-expanded="false"><span class="icon"><i class="fas fa-clipboard-list"></i></span><!-- <i class="fa fa-dollar"></i> --><span class="hide-menu">Manage overweight charge </span></a>
                        </li>

                        <li @if(\Request::segment(2) == 'viewinventry')class="active" @endif > <a class=" waves-effect " href="{{route('laundrylogs.inventoryindex')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"> --><span class="icon"><i class="fas fa-clipboard-list"></i></span><span class="hide-menu">View inventory</span></a>
                        </li>

                        <li @if(\Request::segment(2) == 'staff')class="active" @endif> <a class=" waves-effect " href="{{route('staff_members.index')}}" aria-expanded="false"><!-- i class="mdi mdi-account-star-variant"></i> --><span class="icon"><i class="fas fa-user-friends"></i></span><span class="hide-menu">Manage Staff Member</span></a>
                        </li>
                        <li class="sidebar-item dropdown" id="crm_menubtn" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="hide-menu"><!-- <i class="fa fa-list" aria-hidden="true" style="font-size: 15px;"></i>&nbsp; --><span class="icon"><i class="fas fa-chart-line"></i></span>Manage Sales</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtn" aria-labelledby="crm_menubtn">
                                <li class="sidebar-item"> <a class=" waves-effect " href="{{route('laundryplans.index')}}" aria-expanded="false"><i class="fas fa-tshirt"></i><span class="hide-menu">Laundry</span></a>
                                </li>

                                <li class="sidebar-item"> <a class=" waves-effect " href="{{route('housekeepingplans.index')}}" aria-expanded="false"><i class="fas fa-house-user"></i><span class="hide-menu">Housekeeping</span></a>
                                </li>

                                <li class="sidebar-item"> <a class=" waves-effect " href="{{route('storageplans.index')}}" aria-expanded="false"><i class="fas fa-box-open"></i><span class="hide-menu">Storage</span></a>
                                </li>

                                <li class="sidebar-item"> <a class=" waves-effect " href="{{route('addons.index')}}" aria-expanded="false"><i class="fas fa-puzzle-piece"></i>Add-ons</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'fees')class="active" @endif > <a class=" waves-effect " href="{{route('fees')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Manage Fee</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'tax_fees')class="active" @endif > <a class=" waves-effect " href="{{route('tax_fees.index')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Manage Tax</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'coupons')class="active" @endif > <a class=" waves-effect " href="{{route('coupons.index')}}" aria-expanded="false"><i class="mdi mdi-ticket-percent"></i><span class="hide-menu">Manage Coupons</span></a>

                            </ul>
                        </li> 
                        
                        <li class="sidebar-item dropdown" id="crm_menubtnd222" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                
                                <span class="icon"><i class="fas fa-copy"></i></span><span class="hide-menu">Manage Copy</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd222" aria-labelledby="crm_menubtnd222">
                                <li @if(\Request::segment(2) == 'schools')class="active" @endif > <a class=" waves-effect " href="{{route('schools.index')}}" aria-expanded="false"><i class="mdi mdi-ticket-percent"></i><span class="hide-menu">Update Schools</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'school/availability')class="active" @endif > <a class=" waves-effect " href="{{route('schools.add_availability')}}" aria-expanded="false"><i class="mdi mdi-ticket-percent"></i><span class="hide-menu"> Manage Availability</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'faqs')class="active" @endif > <a class=" waves-effect " href="{{route('faqs.index')}}" aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu">FAQ's</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'cmspages')class="active" @endif> <a class=" waves-effect " href="{{route('cmspages.index')}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">CMS</span></a>
                                </li>
                                <!-- <li @if(\Request::segment(2) == 'thanksPage')class="active" @endif> <a class=" waves-effect " href="{{route('thanks')}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Thank you</span></a>
                                </li> -->

                                <li @if(\Request::segment(2) == 'school/thanks-page')class="active" @endif> <a class=" waves-effect " href="{{route('thanks.school_thanks')}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">School Thanks page</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'laundry')class="active" @endif> <a class=" waves-effect " href="{{route('laundrythanks',['service' => 'Laundry'])}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Intro text Laundry</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'housekeeping')class="active" @endif> <a class=" waves-effect " href="{{route('laundrythanks',['service' => 'Housekeeping'])}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Intro text Housekeeping</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'storage')class="active" @endif> <a class=" waves-effect " href="{{route('laundrythanks',['service' => 'Storage'])}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Intro text Storage</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'aboutus')class="active" @endif> <a class=" waves-effect " href="{{route('cmspages.aboutus')}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">About us</span></a>
                                </li> 

                                <li @if(\Request::segment(2) == 'how_it_work')class="active" @endif> <a class=" waves-effect " href="{{route('how_it_work')}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">How it works</span></a>
                                </li> 

                                <li @if(\Request::segment(2) == 'cmspages/add')class="active" @endif> <a class=" waves-effect " href="{{route('cmspages.editForm',9)}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Reset password content</span></a>
                                </li> 
                                <li @if(\Request::segment(2) == 'cmspages/edit')class="active" @endif> <a class=" waves-effect " href="{{route('cmspages.editForm',10)}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Cancel plan</span></a>
                                </li> 
                                 
                                <li @if(\Request::segment(2) == 'insurance')class="active" @endif > <a class=" waves-effect " href="{{route('insurance.index')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu" >Insurance Plan Table</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'insurance/plan')class="active" @endif > <a class=" waves-effect " href="{{route('insurance.planindex')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu" >Insurance Plan</span></a>
                                </li> 

                                <li @if(\Request::segment(2) == 'referfriend')class="active" @endif > <a class=" waves-effect " href="{{ route('referfriend.sales.button',['id'=>1])}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu" >Service sales button</span></a>
                                </li> 
                                <li @if(\Request::segment(2) == 'prefferences')class="active" @endif > <a class=" waves-effect " href="{{ route('prefferences.button',['id'=>1])}}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu" >Preferences</span></a>
                                </li> 
                            </ul>
                        </li>

                        <li class="sidebar-item dropdown" id="crm_menubtnd222" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon"><i class="fas fa-exclamation-circle"></i>  </span><span class="hide-menu">Claims & Cancelations</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true"></i><b class="noti">{{ $cancelsubscription + $claims }}</b></span></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd222" aria-labelledby="crm_menubtnd222">
                                <li @if(\Request::segment(2) == 'subscription.cancelations')class="active" @endif > <a class=" waves-effect " href="{{route('subscription.cancelations')}}" aria-expanded="false"><i class="fa fa-square-o"></i><span class="hide-menu">Cancelations <b class="noti">{{ $cancelsubscription }}</b></span></a>
                                </li> 
                                <li @if(\Request::segment(2) == 'claims')class="active" @endif > <a class=" waves-effect " href="{{route('claims.index')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Claims Center<b class="noti">{{ $claims }}</b></span></a>
                                </li>

                                 
                            </ul>
                        </li>
                        </li>
                        <!-- <li @if(\Request::segment(2) == 'buildings')class="active" @endif > <a class=" waves-effect " href="{{route('buildings.index')}}" aria-expanded="false"><i class="mdi mdi-ticket-percent"></i><span class="hide-menu">Manage Building</span></a>
                        </li> --> 
                        

                        <li @if(\Request::segment(2) == 'transactions')class="active" @endif > <a class=" waves-effect " href="{{route('transactions.index')}}" aria-expanded="false"><span class="icon"> <i class="fas fa-file-invoice-dollar"></i>   </span><span class="hide-menu">Manage Billing </span></a>
                        </li> 

                       <!--  <li @if(\Request::segment(2) == 'Storagereview')class="active" @endif > <a class=" waves-effect " href="{{route('storage.review')}}" aria-expanded="false"><i class="fa fa-square-o"></i><span class="hide-menu">Storage Review</span></a>
                        </li>
                        -->

                        

                        <!-- <li class="sidebar-item dropdown" id="crm_menubtnd" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="hide-menu"><i class="fa fa-list" aria-hidden="true" style="font-size: 15px;"></i>&nbsp;Laundry Inventory</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true" style="font-size: 14px;"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd" aria-labelledby="crm_menubtnd">
                                <li @if(\Request::segment(2) == 'printable-laundrylogs')class="active" @endif > <a class=" waves-effect " href="{{route('laundrylogs.printable')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Manage Laundry Logs</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'printable-storage-review')class="active" @endif> <a class=" waves-effect " href="{{route('printable_storage.review')}}" aria-expanded="false"><i class="fa fa-square-o"></i><span class="hide-menu">Storage Review</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'printable-subscription')class="active" @endif> <a class=" waves-effect " href="{{route('printable_subscription.cancelations')}}" aria-expanded="false"><i class="fa fa-square-o"></i><span class="hide-menu">Manage cancelation</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'manage-printable-fee')class="active" @endif> <a class="waves-effect " href="{{route('printable.fees')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Manage Fee</span></a>
                                </li> 
                            </ul>
                        </li>  -->
                        <li class="sidebar-item dropdown" id="crm_menubtnd22" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon"><i class="fas fa-question-circle"></i>  </span><span class="hide-menu">Emergency Message Center</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd22" aria-labelledby="crm_menubtnd22">
                                <li @if(\Request::segment(2) == 'printable-laundrylogs')class="active" @endif > <a class=" waves-effect " href="{{route('emergencymessage.usersindex')}}" aria-expanded="false"><span class="hide-menu">Users</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'printable-storage-review')class="active" @endif> <a class=" waves-effect " href="{{route('emergencymessage.schoolindex')}}" aria-expanded="false"><span class="hide-menu">Schools</span></a>
                                </li>
                                 
                            </ul>
                        </li>

                        <li class="sidebar-item dropdown" id="crm_menubtnd22" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon"><i class="fas fa-question-circle"></i>  </span><span class="hide-menu">Thanks page service</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd22" aria-labelledby="crm_menubtnd22">
                                <li @if(\Request::segment(2) == 'thanks/laundry')class="active" @endif > <a class=" waves-effect " href="{{route('thanks.laundry_service')}}" aria-expanded="false"><span class="hide-menu">Laundry</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'thanks/hosuekeeping')class="active" @endif> <a class=" waves-effect " href="{{route('thanks.housekeeping_service')}}" aria-expanded="false"><span class="hide-menu">Housekeeping</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'thanks/storage')class="active" @endif> <a class=" waves-effect " href="{{route('thanks.storage_service')}}" aria-expanded="false"><span class="hide-menu">Storage</span></a>
                                </li>

                                <li @if(\Request::segment(2) == 'thanks/laundry-housekeeping')class="active" @endif> <a class=" waves-effect " href="{{route('thanks.laundry_housekeeping')}}" aria-expanded="false"><span class="hide-menu">Laundry & Housekeeping</span></a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li @if(\Request::segment(2) == 'contactus')class="active" @endif > <a class=" waves-effect " href="{{route('contactus.index')}}" aria-expanded="false">
                            <span class="icon"><i class="fas fa-address-book"></i></span><span class="hide-menu">Manage Contact us</span></a>
                        </li> 
                    </ul>
                </nav>


                @else
                <?php 
                    
                   // print_r(); die();
                ?>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- <li class="nav-devider"></li>
                        <li @if(\Request::segment(2) == 'home')class="active" @endif > <a class=" waves-effect " href="{{route('staff.home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li> -->
                       <!--  <li @if(\Request::segment(2) == 'orders')class="active" @endif > <a class=" waves-effect " href="{{route('staff.orders.all')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">New Orders <b class="noti">{{ $new_orders }}</b></span></a>
                        </li>
                       -->


                        <li @if(\Request::segment(2) == 'orders')class="active" @endif > <a class=" waves-effect " href="{{route('staff.orders.all')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-cash-register"></i></span><span class="hide-menu">New Orders <b class="noti">{{ $newOrderAssign }}</b></span></a>
                        </li>

                        <li @if(\Request::segment(2) == 'users')class="active" @endif> <a class=" waves-effect " href="{{route('staff.users.indexs')}}" aria-expanded="false"><!-- <i class="fa fa-users"></i> --><span class="icon"><i class="fas fa-user-friends"></i></span><span class="hide-menu">My Customers</span></a>
                        </li> 

                        @if(\Auth::user()->role_assignment == 'Laundry')
                            <li @if(\Request::segment(2) == 'claims')class="active" @endif > <a class=" waves-effect " href="{{route('staff.claims.index')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-exclamation-circle"></i>  </span><span class="hide-menu">Claims Center<b class="noti">{{ $claims }}</b></span></a>
                            </li>
                            <!-- <li @if(\Request::segment(2) == 'laundrylogs/printable-laundrylogs')class="" @endif > <a class=" waves-effect " href="{{route('staff.laundrylogs.printable')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Laundry Inventory</span></a>
                                    </li> -->

                            
                            <li @if(\Request::segment(2) == 'laundrylogs')class="active" @endif > <a class=" waves-effect " href="{{route('staff.laundrylogs.index')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-clipboard-list"></i></span><span class="hide-menu">Laundry Inventory</span></a>
                            </li>
                        @else
                            <li @if(\Request::segment(2) == 'schedule')class="active" @endif > <a class=" waves-effect " href="{{route('staff.scheduler.index')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"></i> --><span class="icon"><i class="fas fa-calendar-alt"></i></span><span class="hide-menu">Today’s Schedule <b class="noti">{{ $today_schedule }}</b></span></a>
                            </li>
                        @endif

                        <li @if(\Request::segment(2) == 'transactions')class="active" @endif > <a class=" waves-effect " href="{{route('staff.transactions.index')}}" aria-expanded="false"><!-- <i class="fa fa-dollar"> --><span class="icon"> <i class="fas fa-file-invoice-dollar"></i>   </span></i><span class="hide-menu">Manage Billing </span></a>
                        </li>


                        <!-- <li @if(\Request::segment(2) == 'subscription.cancelations')class="active" @endif > <a class=" waves-effect " href="{{route('staff.subscription.cancelations')}}" aria-expanded="false"><i class="fa fa-square-o"></i><span class="hide-menu">Manage Cancelations <b class="noti">{{ $cancelsubscription }}</b></span></a>
                        </li> --> 


                        <li class="sidebar-item dropdown" id="crm_menubtnd22" aria-haspopup="false" aria-expanded="true">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link  justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                                <span class="hide-menu"><!-- <i class="fa fa-list" aria-hidden="true" style="font-size: 15px;"></i>&nbsp; --><span class="icon"><i class="fas fa-question-circle"></i>  </span>Emergency Message Center</span>
                               <span> <i class="fa fa-chevron-down" aria-hidden="true" style="font-size: 14px;"></i></span>
                            </a>
                            <ul class="sidebar-item crm_menubtnd22" aria-labelledby="crm_menubtnd22">
                                <li @if(\Request::segment(2) == 'printable-laundrylogs')class="active" @endif > <a class=" waves-effect " href="{{route('staff.emergencymessage.usersindex')}}" aria-expanded="false"><span class="hide-menu">Users</span></a>
                                </li>
                                <li @if(\Request::segment(2) == 'printable-storage-review')class="active" @endif> <a class=" waves-effect " href="{{route('staff.emergencymessage.schoolindex')}}" aria-expanded="false"><span class="hide-menu">Schools</span></a>
                                </li>
                                 
                            </ul>
                        </li>

                    </ul>
                </nav>


                @endif



                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor" style="padding-left: 5px;">{{ucfirst(\Request::segment(2))}}</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ ucfirst(\Request::segment(2)) }}</li>
                    </ol>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
               @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2020 Admin Press Admin by themedesigner.in
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    @if(\Request::segment(2) != 'schedule')
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    @endif
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="{{asset('assets/plugins/chartist-js/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <!--morris JavaScript -->
    <script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('assets/plugins/morrisjs/morris.min.js')}}"></script>
    <!-- Vector map JavaScript -->
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    {{-- <script src="{{asset('assets/js/dashboard2.js')}}"></script> --}}
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    
    <link href="{{asset('assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script> 
</body>

    <script>
        $(document).ready(function(){

            $('.print').on('click', function() {

                url = $(this).data('url');
               /* alert(url); 
                return false;*/
                let CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');

                $.ajaxSetup({
                  url: url,
                  type: "get",
                  data: {
                    _token: CSRF_TOKEN,
                  }, 
                });

                $.ajax({
                  success: function(viewContent) {
                    /*$("#printabledata").print({mediaPrint : false,
                    });*/ 
                    var prtContent = document.getElementById("printabledata");
                    var WinPrint = window.open();
                    WinPrint.document.write(prtContent.innerHTML);
                    WinPrint.document.close();
                    WinPrint.focus();
                    WinPrint.print();
                    WinPrint.close();
                  }
                });
              });

            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $('#small').click(function(){

                if($('#imagee').hasClass('imagesmall')){
                    $('#imagee').removeClass('imagesmall');
                }else{
                    $('#imagee').addClass('imagesmall');
                }
                // alert($(this).hasClass('imagesmall'))
            })
        });

        $(document).ready(function(){
          $(".modal").modal({
            show:false,
            backdrop:'static'
            });
          
            $('.cancelbtn').on('click', function (e) {
                var $t = $(this),
                    target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
                
              $(target)
                .find("input,textarea,select")
                   .val('')
                   .end()
                .find("input[type=checkbox], input[type=radio]")
                   .prop("checked", "")
                   .end();
                $('#delete_password_error').hide();
                $('#password_error').hide();
                
            })

            $(".schools_ids").select2();
            $(".users_names_ids").select2();

            $(".allow_decimal").on("input", function(evt) {
                 var self = $(this);
                 self.val(self.val().replace(/[^0-9\.]/g, ''));
                 if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
                 {
                   evt.preventDefault();
                 }
            });

            
            $('.allow_decimal').keypress(function(event) {
                
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
                    ((event.which < 48 || event.which > 57) &&
                    (event.which != 0 && event.which != 8))) {
                    event.preventDefault();
                }

                var text = $(this).val();

                if ((text.indexOf('.') != -1) &&
                    (text.substring(text.indexOf('.')).length > 1) &&
                    (event.which != 0 && event.which != 8) &&
                    ($(this)[0].selectionStart >= text.length - 1)) {
                    event.preventDefault();
                }
            });

          });
    </script>

</html>
