<ul class="metismenu" id="menu-bar">

    <li><a href="{{ route('admin.dashboard') }}" class="{{ in_array(Route::currentRouteName(), ['admin.dashboard']) ? 'active' : '' }}"><i class="uil-home-alt"></i><span> Dashboard </span></a></li>

    {{-- <li><a href="{{ route('admin.user.index') }}" class="{{ in_array(Route::currentRouteName(),[ 'admin.user.index', 'admin.user.create' ]) ? 'active' : '' }}"><i class="uil-users-alt"></i><span>Users</span></a></li>
    
    <li><a href="{{ route('admin.blogs.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.blogs.index','admin.blogs.create','admin.blogs.edit']) ? 'active' : '' }}"><i class="uil-file-alt"></i>Blogs</span></a></li> --}}

    <li><a href="{{ route('admin.enquiry.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.  .index']) ? 'active' : '' }}"><i class="uil uil-phone"></i><span>Enquiries </span></a></li>

    {{-- <li><a href="{{ route('admin.email') }}" class="{{ in_array(Route::currentRouteName(),['admin.email','admin.add.email','admin.edit.email']) ? 'active' : '' }}"><i class="uil-envelope"></i>Email Templates</span></a></li> --}}

    <li>
        <a href="javascript: void(0);" class=""><i class="uil-cog"></i>Settings </span><span class="menu-arrow"></span></a>
        <ul class="nav-second-level" aria-expanded="false">
            <li><a href="{{ route('admin.settings') }}" class="{{ in_array(Route::currentRouteName(),['admin.settings']) ? 'active' : '' }}">App Settings</a></li>
            {{-- <li><a href="{{ route('admin.about-us') }}" class="{{ in_array(Route::currentRouteName(),['admin.about-us']) ? 'active' : '' }}">About</a></li>

            <li><a href="{{ route('admin.privacy-policy') }}" class="{{ in_array(Route::currentRouteName(),['admin.privacy-policy']) ? 'active' : '' }}">Privacy Policy</a></li>

            <li><a href="{{ route('admin.terms-&-conditions') }}" class="{{ in_array(Route::currentRouteName(),['admin.terms-&-conditions']) ? 'active' : '' }}">Terms & Conditions</a></li> --}}
        </ul>
    </li>
</ul>
