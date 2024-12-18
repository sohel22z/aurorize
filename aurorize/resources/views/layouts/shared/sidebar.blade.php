<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        @php 
        $image = Helper::assets('assets/images/school-logo.png');  $school_name = "School name";
        if(\Session::has('currentSchool')){
            $image = \Session::get('currentSchool')->image;
            $school_name = \Session::get('currentSchool')->name;
        }
        @endphp
        <img src="{{ $image }}" alt="Logo" class="avatar-sm rounded-circle mr-2">
        <img src="{{ $image }}" alt="Logo" class="avatar-xs rounded-circle mr-2">
        <div class="media-body text-left">
            <h6 class="pro-user-name mt-0 mb-0">
            <span>{{$school_name}}</span>
            </h6>
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu school-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down ml-2 align-self-center"><polyline points="4 6 8 10 12 6"></polyline></svg></a>
            <div class="dropdown-menu profile-dropdown-items">
                @if(\Session::has('schools'))
                @foreach (\Session::get('schools') as $school)
                <a href="{{ route('school.change', ['id' => $school->school->_id ]) }}" class="dropdown-item notify-item">
                    <div class="media">
                        <div class="media-left"><span class="image">
                            @if($school->school->image == "")
                            Logo
                            @else
                            <img src="{{ $school->school->image }}" alt="Logo" class="img-fluid">
                            @endif
                        </span></div>
                        <div class="media-body media-middle"><span>{{ $school->school->name }}</span></div>
                    </div>
                </a>
                @endforeach
                @endif
                <a href="{{ route('school.create') }}" class="dropdown-item notify-item">
                    <div class="media">
                        <div class="media-left"><span class="image"><svg xmlns="http://www.w3.org/2000/svg" id="prefix__plus" width="14.099" height="14.099" viewBox="0 0 14.099 14.099"><g id="prefix__Group_724" data-name="Group 724"><path id="prefix__Path_906" fill="#0fa05b" d="M7.929 6.17V0H6.17v6.17H0v1.759h6.17V14.1h1.759V7.929H14.1V6.17z" data-name="Path 906"/></g></svg></span></div>
                        <div class="media-body media-middle"><span>Create school</span></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            @include('layouts.shared.app-menu')
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
