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
        <form role="search" class="navbar-form-custom" method="post" action="#">
            <div class="form-group">
                {{--<input type="text" placeholder="Search something special" class="form-control" name="search">--}}
            </div>
        </form>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                @if(Auth::user()->role_id == 1)
				<li class="dropdown">

                <?php
                    $notify_data =Session::get('notify_data');
                    //print_r($notify_data);
                ?>
                    <a class="dropdown-toggle label-menu-corner" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{ @$notify_data['notify_count'] }}</span>
                    </a>
                    <ul class="dropdown-menu hdropdown animated flipInX">
                        <div class="title">
                            You have {{ @$notify_data['notify_count'] }} Report Page Notifications

                                {{--//print_r(count($shajjad));
                            //echo $shajjad['0']['name'];--}}


                        </div>
                        <li>
                            <a style="color:#505050">
                                Air Safety Report<span style="color:#993322"> &nbsp;({{ @$notify_data['safety'] }})</span>
                            </a>
                        </li>
                        <li>
                            <a style="color:#505050">
                                Cabin Crew Report<span style="color:#993322"> &nbsp;({{ @$notify_data['cabin'] }})</span>
                            </a>
                        </li>
                        <li>
                            <a style="color:#505050">
                                Confidential Safety Report<span style="color:#993322"> &nbsp;({{ @$notify_data['confident'] }})</span>
                            </a>
                        </li>
                        <li>
                            <a style="color:#505050">
                                Dangerous Goods Occurrence Report<span style="color:#993322"> &nbsp;({{ @$notify_data['operation'] }})</span>
                            </a>
                        </li>
                        <li>
                            <a style="color:#505050">
                                Ground Handling Report<span style="color:#993322"> &nbsp;({{ @$notify_data['ground'] }})</span>
                            </a>
                        </li>
                        <li>
                            <a style="color:#505050">
                                Maintenance Occurrence Report<span style="color:#993322"> &nbsp;({{ @$notify_data['maintenance'] }})</span>
                            </a>
                        </li>
                        {{--<li class="summary"><a href="#">See All Messages</a></li>--}}
                    </ul>
                </li>
                @endif
                <li class="dropdown">
                    {{--<a href="{{Route('get-user-login')}}">
                        <i class="pe-7s-upload pe-rotate-90"></i>
                    </a>--}}

                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small style="font-size: small">{{isset(Auth::user()->username)?ucfirst(Auth::user()->username):''}}<b class="caret"></b></small>
                    </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{Route('user-profile')}}">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{Route('user-logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>