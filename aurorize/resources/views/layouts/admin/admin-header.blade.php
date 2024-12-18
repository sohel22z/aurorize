<!-- Topbar Start -->
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="24"/>
            </span>
            <span class="logo-sm">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="18"/>
            </span>
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            @if(isset($menuIcon) && $menuIcon)
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
            @endif
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            {{-- <li class="dropdown notification-list noti-list">
                <a class="nav-link dropdown-toggle noti-icon pl-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-item noti-title border-bottom">
                        <h5 class="font-size-16 m-0">
                            Notifications
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll noti-body">
                        <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                            <p class="notify-details ml-0">Lorem ipsum dolor sit amet, consetetur ipscing elitr, sed
                                diam nonumy eirmod.<small class="text-muted opacity8">2 mins ago</small>
                            </p>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                            <p class="notify-details ml-0">Lorem ipsum dolor sit amet, consetetur ipscing elitr, sed
                                diam nonumy eirmod.<small class="text-muted opacity8">2 mins ago</small>
                            </p>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                            <p class="notify-details ml-0">Lorem ipsum dolor sit amet, consetetur ipscing elitr, sed
                                diam nonumy eirmod.<small class="text-muted opacity8">2 mins ago</small>
                            </p>
                        </a>
                    </div>
                </div>
            </li> --}}

            <li class="dropdown notification-list align-self-center profile-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <div class="media user-profile ">
                        <span class="image font-size-14">{{ substr(Auth::guard('admin')->user()->name,0,1) }}</span>
                        <div class="media-body text-left">
                            <h6 class="pro-user-name ml-2 my-0">
                                <span>{{Auth::guard('admin')->user()->name}}</span>
                            </h6>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down ml-2 align-self-center"><polyline points="4 6 8 10 12 6"></polyline></svg>
                    </div>
                </a>
                <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                    <a href="{{ route('admin.change.password') }}" class="dropdown-item notify-item">
                        <span>Change Password</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item notify-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span>Sign out</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- end Topbar -->
