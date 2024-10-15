<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href=""
            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 2000px;">
            ระบบการคัดกรองข้อมูลและประเมินสภาวะของผู้สูงอายุผ่านคิวอาร์โค้ด
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if (in_array(session('position_id'), [1, 2]))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="no-icon">ข้อมูล</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('all-user') }}">ข้อมูลผู้ใช้</a>
                            <a class="dropdown-item" href="{{ route('all-elderly') }}">ข้อมูลผู้สูงอายุ</a>
                            @if (session('position_id') == 1)
                            <a class="dropdown-item" href="{{ route('all-department') }}">ข้อมูลแผนก</a>
                            <a class="dropdown-item" href="{{ route('all-position') }}">ข้อมูลตำแหน่ง</a>
                            @endif
                        </div>
                    </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="no-icon">ออกจากระบบ</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJTYFFT6CG9gQTcI4z0P4E2HEG6D9JTvrsIN7llpfnN0aiT5X" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy42MsP3f8V6p/rC2F/o1nDO0yM6ojL6lAbkR8" crossorigin="anonymous"></script>
