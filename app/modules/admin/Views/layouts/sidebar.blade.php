<div id="navigation">
<!--
    <div class="profile-picture">

        <div class="stats-label text-color">
            <span class="font-extra-bold font-uppercase">{{isset(Auth::user()->username)?ucfirst(Auth::user()->username):''}}</span>

            <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><b class="caret"></b>
                    {{--<small class="text-muted">Founder of App <b class="caret"></b></small>--}}
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="{{Route('user-profile')}}">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{Route('user-logout')}}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
-->

    <ul class="nav" id="side-menu">
        <li class="active">
            <a href="#"> <i class="fa fa-sticky-note-o"></i> <span class="nav-label">Operational Safety reports</span><span class="fa arrow"></span> </a>
			<ul class="nav nav-second-level collapse" aria-expanded="false">
				<li><a href="{{route('air-safety')}}">Air Safety Report</a></li>
				<li><a href="{{ url('cabin-crew') }}">Cabin Crew Report</a></li>
				<li><a href="{{ url('confidential-safety') }}">Confidential Safety Report</a></li>
				<li><a href="{{ url('operational-safety') }}">Dangerous Goods Occurrence Report</a></li>
				<li><a href="{{ url('ground-handling') }}">Ground Handling Report</a></li>
				<li><a href="{{ url('maintenance-occurrence') }}">Maintenance Occurrence Report</a></li>
			</ul>
        </li>
		
		<li class="active">
            <a href="#"> <i class="fa fa-info-circle"></i> <span class="nav-label">Safety Department Info</span><span class="fa arrow"></span> </a>
			<ul class="nav nav-second-level collapse" aria-expanded="false">
				<li><a href="{{route('safety-bulletin')}}">Safety Bulletins</a></li>
				<li><a href="{{route('alerts')}}">Safety Alerts</a></li>
				<li><a href="{{route('safety-manuals')}}">Safety Manual</a></li>
			</ul>
        </li>
		<li class="active">
            <a href="#"> <i class="fa fa-users"></i> <span class="nav-label">User Manager</span> </a>
        </li>
		<li class="active">
            <a href="#"> <i class="fa fa-list"></i> <span class="nav-label">Activity Log</span> </a>
        </li>
		<li class="active">
            <a href="#"> <i class="fa fa-at"></i> <span class="nav-label">Contact US</span> </a>
        </li>
        @if(file_exists(app_path().'/modules/user/Views/layouts/user_sidebar.blade.php'))
            @include('user::layouts.user_sidebar')
        @endif
    </ul>
</div>