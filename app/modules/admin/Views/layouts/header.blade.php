<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        {{--<span>
            User System
        </span>--}}
        <img src="{{ URL::to('/') }}/assets/img/logo22.png" alt="bZm Graphics" class="bgm_logo_img">
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary"></span>
        </div>
        {{--<form role="search" class="navbar-form-custom" method="post" action="#">
            <div class="form-group">
                <input type="text" placeholder="Search something special" class="form-control" name="search">
            </div>
        </form>--}}
        <style>
            .right-nav { width:auto; list-style: none; float: right; border: 0px solid #f00; padding:10px 5% 0 0;}
            .right-nav li { display: inline-block; position: relative;  }
            .right-nav li a.notification i { position: relative; font-size: 25px; margin: 0 20px 0 0; }
            .right-nav li a.notification span.lbl { position: absolute; right:15px; top:0; padding:0 3px; color: #fff; background:#f00; font-size: 10px; font-weight: bold;}
            .right-nav li ul li { display: block;}
        </style>
        <div style="border: 0px solid #f00;">
            {{--<div class="navbar-right">--}}
            <div class="">
                {{--<ul class="nav navbar-nav no-borders" style="width: 300px; border: 1px solid #f00;">--}}
                <ul class="right-nav">
                    @if(isset(Auth::user()->role_id))

                        @if(Auth::user()->role_id == '1')
                        <li class="dropdown">
                        <?php
                            $notify_data =Session::get('notify_data');
                            //print_r($notify_data);
                        ?>
                            <a class="dropdown-toggle label-menu-corner notification" href="#" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                {{--<span class="label label-success">{{ isset($notify_data['notify_count'])?$notify_data['notify_count']:'' }}</span>--}}
                                <span class="lbl">{{ isset($notify_data['notify_count'])?$notify_data['notify_count']:'' }}</span>
                            </a>
                            <ul class="dropdown-menu hdropdown animated flipInX notification-list" style=" margin-left:-200px; ">
                                <div class="title">
                                    <strong>You have {{ isset($notify_data['notify_count'])?$notify_data['notify_count']:'' }} Report Page Notifications</strong>
                                        {{--//print_r(count($shajjad));
                                    //echo $shajjad['0']['name'];--}}
                                </div>
                                <li>
                                    <a href="{{ route('notify-safety') }}" style="color:#505050"><strong>Air Safety Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['safety'])?$notify_data['safety']:'' }})</span></a>
                                    {{--<a style="color:#505050">
                                        Air Safety Report<span style="color:#993322"> &nbsp;({{ @$notify_data['safety'] }})</span>
                                    </a>--}}
                                </li>
                                <li>
                                    <a href="{{ route('notify-cabin') }}" style="color:#505050"><strong>Cabin Crew Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['cabin'])?$notify_data['cabin']:'' }})</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('notify-confidential') }}" style="color:#505050"><strong>Confidential Safety Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['confident'])?$notify_data['confident']:'' }})</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('notify-dangerous') }}" style="color:#505050"><strong>Dangerous Goods Occurrence Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['operation'])?$notify_data['operation']:'' }})</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('notify-ground') }}" style="color:#505050"><strong>Ground Handling Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['ground'])?$notify_data['ground']:'' }})</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('notify-maintenance') }}" style="color:#505050"><strong>Maintenance Occurrence Report</strong><span style="color:#993322"> &nbsp;({{ isset($notify_data['maintenance'])?$notify_data['maintenance']:'' }})</span></a>
                                </li>
                                {{--<li class="summary"><a href="#">See All Messages</a></li>--}}
                            </ul>
                        </li>
                        @endif
                    @endif
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <small style="font-size: small">{{isset(Auth::user()->username)?ucfirst(Auth::user()->username):''}}<b class="caret"></b></small>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{Route('user-profile')}}">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{Route('user-logout')}}">Logout</a></li>
                        </ul>
                    </li>
                    <div style="clear: both"></div>
                </ul>
            </div>
        <div style="clear: both"></div>
        </div>

    </nav>
</div>