<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <a class="logo d-lg-none" href="{{ url('/dashboard') }}"><img src="{{ asset('assets/img/enigma-logo.png') }}" alt="logo"></a>

        <ul class="topbar-btns">

            <!-- Notifications -->
            <li class="dropdown d-none d-lg-block">
                <span class="topbar-btn has-new" data-toggle="dropdown"><i class="ti-bell"></i></span>
                <div class="dropdown-menu">

                    <div class="media-list media-list-hover media-list-divided media-list-xs">
                        <a class="media media-new" href="#">
                            <span class="avatar bg-success"><i class="ti-user"></i></span>
                            <div class="media-body">
                                <p>New user registered</p>
                                <time datetime="2017-07-14 20:00">Just now</time>
                            </div>
                        </a>

                        <a class="media" href="#">
                            <span class="avatar bg-info"><i class="ti-shopping-cart"></i></span>
                            <div class="media-body">
                                <p>New order received</p>
                                <time datetime="2017-07-14 20:00">2 min ago</time>
                            </div>
                        </a>

                        <a class="media" href="#">
                            <span class="avatar bg-warning"><i class="ti-face-sad"></i></span>
                            <div class="media-body">
                                <p>Refund request from <b>Ashlyn Culotta</b></p>
                                <time datetime="2017-07-14 20:00">24 min ago</time>
                            </div>
                        </a>

                        <a class="media" href="#">
                            <span class="avatar bg-primary"><i class="ti-money"></i></span>
                            <div class="media-body">
                                <p>New payment has made through PayPal</p>
                                <time datetime="2017-07-14 20:00">53 min ago</time>
                            </div>
                        </a>
                    </div>

                    <div class="dropdown-footer">
                        <div class="left">
                            <a href="#">Read all notifications</a>
                        </div>

                        <div class="right">
                            <a href="#" data-provide="tooltip" title="Mark all as read"><i class="fa fa-circle-o"></i></a>
                            <a href="#" data-provide="tooltip" title="Update"><i class="fa fa-repeat"></i></a>
                            <a href="#" data-provide="tooltip" title="Settings"><i class="fa fa-gear"></i></a>
                        </div>
                    </div>

                </div>
            </li>
            <!-- END Notifications -->


        </ul>
    </div>

    <div class="topbar-right">

        <ul class="topbar-btns">
            <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="{{ asset('assets/img/avatar/default.jpg') }}" alt="..."></span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </div>
            </li>
        </ul>

        <form class="lookup lookup-circle lookup-right" target="index.html">
            <input type="text" name="s">
        </form>

    </div>
</header>
<!-- END Topbar -->

<!-- Main container -->
<main>