<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo">ระบบการคัดกรองข้อมูลและประเมินสภาวะของผู้สูงอายุผ่านคิวอาร์โค้ดของสำนักงานสาธารณสุขจังหวัดบุรีรัมย์</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                {{--  <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">Dashboard</span>
                    </a>
                </li>  --}}
                {{--  <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-cloud-download-93"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">Notification</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">Notification 1</a>
                        <a class="dropdown-item" href="#">Notification 2</a>
                        <a class="dropdown-item" href="#">Notification 3</a>
                        <a class="dropdown-item" href="#">Notification 4</a>
                        <a class="dropdown-item" href="#">Another notification</a>
                    </ul>
                </li>  --}}
                {{--  <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nc-icon nc-zoom-split"></i>
                        <span class="d-lg-block">&nbsp;Search</span>
                    </a>
                </li>  --}}
            </ul>
            <ul class="navbar-nav ml-auto">
                {{--  <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        <span class="no-icon">โปรไฟล์</span>
                    </a>
                </li>  --}}
                @if (session('position_id') == 1 ) {{-- การเช็คสิทธิ์ --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">ข้อมูล</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('all-user') }}">ข้อมูลผู้ใช้</a>
                        <a class="dropdown-item" href="{{ route('all-elderly')}}">ข้อมูลผู้สูงอายุ</a>
                        <a class="dropdown-item" href="{{ route('all-department') }}">ข้อมูลแผนก</a>
                        <a class="dropdown-item" href="{{ route('all-position') }}">ข้อมูลตำแหน่ง</a>
                        {{--  <a class="dropdown-item" href="#">Something else here</a>  --}}
                        {{--  <div class="dropdown-divider"></div>  --}}
                        {{--  <a class="dropdown-item" href="#">Separated link</a>  --}}
                    </div>
                </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="no-icon">ออกจากระบบ</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYFFT6CG9gQTcI4z0P4E2HEG6D9JTvrsIN7llpfnN0aiT5X" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy42MsP3f8V6p/rC2F/o1nDO0yM6ojL6lAbkR8" crossorigin="anonymous"></script>
