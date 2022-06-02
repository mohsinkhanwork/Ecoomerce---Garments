<!-- Sidebar -->
<aside class="sidebar sidebar-expand-lg sidebar-light sidebar-sm sidebar-color-info">

    <header class="sidebar-header bg-info">
        <span class="logo">
          <a href="{{ url('/dashboard') }}"><img src="{{ asset('assets/img/enigma-logo.png') }}" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu menu-sm menu-bordery">

            <li class="menu-item active">
                <a class="menu-link" href="{{ url('/dashboard') }}">
                    <span class="icon ti-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="{{ url('/dashboard/manage-customer') }}">
                    <span class="icon ti-user"></span>
                    <span class="title">Customers</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url('/dashboard/manage-subscriber') }}">
                    <span class="icon ti-user"></span>
                    <span class="title">Subscribers</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                </a>
            </li>

            <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ti-settings"></span>
                        <span class="title">Orders</span>
                        {{--<span class="badge badge-pill badge-info">2</span>--}}
                        <span class="arrow"></span>
                    </a>
                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ url('/dashboard/manage-order') }}">
                                <span class="dot"></span>
                                <span class="title">Active</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ url('/dashboard/manage-archived-order') }}">
                                <span class="dot"></span>
                                <span class="title">Archived</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ url('/dashboard/manage-order/export/all') }}">
                                <span class="dot"></span>
                                <span class="title">Export All</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ url('/dashboard/manage-order/shipposync') }}">
                                <span class="dot"></span>
                                <span class="title">Sync with Shippo</span>
                            </a>
                        </li>
                    </ul>
                </li>

            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-shortcode"></span>
                    <span class="title">Promo Codes</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('add.promo.admin') }}">
                            <span class="dot"></span>
                            <span class="title">Add New</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('manage.promo.admin') }}">
                            <span class="dot"></span>
                            <span class="title">Manage</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-briefcase"></span>
                    <span class="title">Products</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/add-product') }}">
                            <span class="dot"></span>
                            <span class="title">Add New</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/manage-product') }}">
                            <span class="dot"></span>
                            <span class="title">Manage</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-briefcase"></span>
                    <span class="title">Categories</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/add-category') }}">
                            <span class="dot"></span>
                            <span class="title">Add New</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/manage-category') }}">
                            <span class="dot"></span>
                            <span class="title">Manage</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-briefcase"></span>
                    <span class="title">Collections</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/add-collection') }}">
                            <span class="dot"></span>
                            <span class="title">Add New</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/manage-collection') }}">
                            <span class="dot"></span>
                            <span class="title">Manage</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="menu-item">
                <a class="menu-link" href="{{ url('/dashboard/settings') }}">
                    <span class="icon ti-settings"></span>
                    <span class="title">Settings</span>
                </a>
            </li> --}}

            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-settings"></span>
                    <span class="title">Settings</span>
                    {{--<span class="badge badge-pill badge-info">2</span>--}}
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/settings/general') }}">
                            <span class="dot"></span>
                            <span class="title">General Settings</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/settings/taxrates') }}">
                            <span class="dot"></span>
                            <span class="title">Tax Rates</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/settings/sliders') }}">
                            <span class="dot"></span>
                            <span class="title">Sliders</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/settings/phone') }}">
                            <span class="dot"></span>
                            <span class="title">Add Phone</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard/settings/pages') }}">
                            <span class="dot"></span>
                            <span class="title">CMS Pages</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>

</aside>
<!-- END Sidebar -->
