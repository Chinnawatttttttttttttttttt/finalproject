<div class="sidebar" > <!-- data-image="{{ asset('assets/img/sidebar-5.jpg') }}" -->
    <div class="sidebar-wrapper">
        <div class="logo d-flex justify-content-center">
            <img src="{{ asset('assets/img/ตรากระทรวงสาธารณสุขใหม่.png') }}" alt="Logo" style="width: 50%;" >
        </div>
        <ul class="nav">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>แดชบอร์ด</p>
                </a>
            </li>
            <li class="{{ Request::is('profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>โปรไฟล์ผู้ใช้งาน</p>
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
                    <p>แบบประเมิน</p>
                </a>
            </li>
            <li class="{{ Request::is('all-score') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('all-score') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>รายงานแบบประเมิน</p>
                </a>
            </li>
            <li class="{{ Request::is('service') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('service') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>ข้อมูลการบริการ</p>
                </a>
            </li>
            <li class="{{ Request::is('maps') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('maps') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>แผนที่</p>
                </a>
            </li>
            <li class="{{ Request::is('notifications') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('news') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>ข่าวสารประชาสัมพันธ์</p>
                </a>
            </li>
            {{--  <li class="nav-item active active-pro {{ Request::is('upgrade') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('upgrade') }}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li>  --}}
        </ul>
    </div>
</div>
