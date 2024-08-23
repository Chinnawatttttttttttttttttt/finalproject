<div class="sidebar" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                TAI
            </a>
        </div>
        <ul class="nav">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ Request::is('profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User Profile</p>
                </a>
            </li>
            <li class="{{ Request::is('all-elderly') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('all-elderly') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>ผู้สูงอายุ</p>
                </a>
            </li>
            <li class="{{ Request::is('tai') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('tai') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li class="{{ Request::is('all-score') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('all-score') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Table List</p>
                </a>
            </li>
            {{--  <li class="{{ Request::is('icons') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('icons') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Icons</p>
                </a>
            </li>  --}}
            <li class="{{ Request::is('maps') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('maps') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Maps</p>
                </a>
            </li>
            {{--  <li class="{{ Request::is('notifications') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Notifications</p>
                </a>
            </li>  --}}
            {{--  <li class="nav-item active active-pro {{ Request::is('upgrade') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('upgrade') }}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li>  --}}
        </ul>
    </div>
</div>
