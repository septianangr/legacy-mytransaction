<nav class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mx-auto navbar navbar-dark bg-dark navbar-expand fixed-bottom p-1">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item @if($nav_name == 'home') active @endif">
            <a href="{{ route('member.home') }}" class="nav-link" title="Halaman Utama">
                <i class="fal fa-home fa-lg"></i>
                <br />
                <span style="font-size: 0.75em;">Beranda</span>
            </a>
        </li>
        <li class="nav-item @if($nav_name == 'users') active @endif" title="Daftar Pengguna">
            <a href="{{ route('user.index') }}" class="nav-link">
                <i class="fal fa-users fa-lg"></i>
                <br />
                <span style="font-size: 0.75em;">Pengguna</span>
            </a>
        </li>
        <li class="nav-item @if($nav_name == 'add-user') active @endif" title="Tambah Data Pengguna">
            <a href="{{ route('user.add') }}" class="nav-link">
                <i class="fal fa-plus-circle fa-lg"></i>
                <br />
                <span style="font-size: 0.75em;">Tambah</span>
            </a>
        </li>
        <li class="nav-item @if($nav_name == 'setting') active @endif" title="Pengaturan Umum">
            <a href="{{ route('setting.index') }}" class="nav-link">
                <i class="fal fa-cog fa-lg"></i>
                <br />
                <span style="font-size: 0.75em;">Pengaturan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logout" data-href="{{ route('auth.logout') }}" title="Logout Akun">
                <i class="fal fa-sign-out fa-lg"></i>
                <br />
                <span style="font-size: 0.75em;">Keluar</span>
            </a>
        </li>
    </ul>
</nav>