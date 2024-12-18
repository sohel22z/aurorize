<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="50"/>
            </span>
            <span class="logo-sm">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="50"/>
            </span>
        </a>
        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about-us') }}"> {{ __('About') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact-us') }}"> {{ __('Contact') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blogs') }}"> {{ __('Blog') }}</a>
            </li>
        </ul>
        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), [ 'login' ]) ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link {{ in_array(Route::currentRouteName(), [ 'register' ]) ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @if($user)
                @if($user->is_active != 0)
                <li class="dropdown notification-list noti-list">
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
                            <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                <p class="notify-details ml-0">Lorem ipsum dolor sit amet, consetetur ipscing elitr, sed
                                    diam nonumy eirmod.<small class="text-muted opacity8">2 mins ago</small>
                                </p>
                            </a>
                        </div>
                    </div>
                </li>
                @endif
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle pl-0" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        @if($user->is_complete_profile == 1 && $user->profile_picture != "")
                        <img src="{{ $user->profile_picture }}" class="avatar-md rounded-circle" alt="" />
                        @else
                        <span class="no-avatar"> {{ substr(ucfirst($user->name), 0, 1) }} </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if($user->is_complete_profile == 1)
                        <a class="dropdown-item notify-item border-bottom {{ in_array(Route::currentRouteName(),[ 'user.profile', 'user.complete.profile' ]) ? 'active' : '' }}" href="{{ route($user->is_active == 0 ? 'user.complete.profile' : 'user.profile') }}">
                            Edit profile details
                        </a>
                        @endif
                        @if($user->is_active != 0)
                        <a class="dropdown-item notify-item border-bottom {{ in_array(Route::currentRouteName(),[ 'change.password' ]) ? 'active' : '' }}" href="{{ route('change.password') }}">
                            {{ __('Change Password') }}
                        </a>
                        @endif
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
            @endif
        </ul> 
    </div>
</div>
