<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ isset($title) ? ($title . ' | ' . config('app.name', 'Easy Counting')) : config('app.name', 'Laravel') }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo_EA7.svg') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/feathericon.min.css') }}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">

<body div="app">    
    <div class="main-wrapper">
        <div class="header">
            <a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-justify"></i> </a>
            <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo"><strong><span class="logoclass">Easy Accounting
                            7</span></strong></a>
                <a href="{{ route('home') }}" class="logo logo-small"><strong><span class="logoclass thetext">Easy
                            Accounting 7</span></strong></a>
            </div>
            <ul class="nav user-menu">
                <li class="nav-item dropdown noti-dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i
                            class="fe fe-bell"></i> <span class="badge badge-pill">3</span> </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a
                                href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media"> <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                    approved <span class="noti-title">your estimate</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media"> <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ URL::to('assets/img/profiles/avatar-11.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">International Software
                                                        Inc</span> has sent you a invoice in the amount of <span
                                                        class="noti-title">$218</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media"> <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ URL::to('assets/img/profiles/avatar-17.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Hendry</span> sent
                                                    a cancellation request <span class="noti-title">Apple iPhone
                                                        XR</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media"> <span class="avatar avatar-sm">
                                                {{-- <img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::to('') }}assets/img/profiles/avatar-13.jpg"> --}}
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Mercury Software
                                                        Inc</span> added a new product <span class="noti-title">Apple
                                                        MacBook Pro</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins
                                                        ago</span> </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
                    </div>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img">
                            @if (Auth::user()->avatar)
                                <img class="rounded-circle"
                                    src="{{ asset('../../assets/img/' . Auth::user()->avatar) }}"
                                    alt="profile_image" style="object-fit: cover; width: 31px; height: 31px;">
                            @elseif (Auth::user()->avatar == 0)
                                <img class="rounded-circle" src="{{ asset('assets/img/profile.png') }}"
                                    alt="profile_image" style="object-fit: cover; width: 31px; height: 31px;">
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            @if (Auth::user()->avatar)
                                <img class="avatar-img rounded-circle"
                                    src="{{ asset('../../assets/img/' . Auth::user()->avatar) }}"
                                    alt="profile_image" style="object-fit: cover; width: 40px; height: 40px;">
                            @elseif (Auth::user()->avatar == 0)
                                <img class="avatar-img rounded-circle"
                                    src="{{ asset('../../assets/img/profile.png') }}" alt="profile_image"
                                    style="object-fit: cover; width: 40px; height: 40px;">
                            @endif
                            <div class="user-text">
                                <h6>{{ Auth::user()->name }}</h6>
                                <p class="text-muted mb-0">{{ Auth::user()->role_name }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                        {{-- <a class="dropdown-item" href="settings.html">Account Settings</a>  --}}
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
            {{-- <div class="top-nav-search">
				<form>
					<input type="text" class="form-control" placeholder="Search here">
					<button class="btn" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div> --}}
        </div>
        {{-- menu --}}
        @include('sidebar.menusidebar')
        {{ $slot }}
    </div>
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
    {{-- <script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/chart.morris.js') }}"></script> --}}

    {{ $scripts }}

    @stack('scripts')
</body>

</html>
