<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper" style="text-align: center;">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid for-light" src="{{ asset('assets/images/MIS_logo.png') }}" alt="logo"
                    style="display: inline-block;">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('menus.index') }}"><i data-feather="menu"></i><span>Menus</span></a></li>
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('dashboard') }}"><i data-feather="star"></i><span>Features</span></a>
                    </li>
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('dashboard') }}"><i data-feather="users"></i><span>Clubs</span></a>
                    </li>
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('dashboard') }}"><i data-feather="briefcase"></i><span>Team
                                Members</span></a></li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i
                                data-feather="mail"></i><span>Contact Us</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('contact-infos.index') }}">Contact Infos</a></li>
                            <li><a href="{{ route('contact-lists.index') }}">Contact Lists</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('dashboard') }}"><i data-feather="settings"></i><span>Settings</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
