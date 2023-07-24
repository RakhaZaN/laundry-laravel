<header style="background-color: #ecf4fc">
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <!-- Logo -->
            <div class="header-left">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo"></a>
                </div>
                <div class="menu-wrapper  d-flex align-items-center">
                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                @guest
                                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="{{ Request::is('about') ? 'active' : '' }}">
                                        <a href="{{ url('/about') }}">About</a>
                                    </li>
                                    <li class="{{ Request::is('services') ? 'active' : '' }}">
                                        <a href="{{ url('/services') }}">Services</a>
                                    </li>
                                    <li class="{{ Request::is('auth/login') ? 'active' : '' }} mt-10 d-lg-none">
                                        <a href="{{ route('auth.login') }}"
                                            class="genric-btn default text-primary">Login</a>
                                    </li>
                                    <li class="{{ Request::is('auth/register') ? 'active' : '' }} d-lg-none">
                                        <a href="{{ route('auth.register') }}" class="genric-btn info">Register</a>
                                    </li>
                                @endguest
                                @auth
                                    @switch(auth()->user()->peran)
                                        @case('admin')
                                            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                                                <a href="{{ route('admin.menu') }}">Dashboard</a>
                                            </li>
                                            <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                                                <a href="{{ route('admin.users.index') }}">Users</a>
                                            </li>
                                            <li class="{{ Request::is('admin/layanan*') ? 'active' : '' }}">
                                                <a href="{{ route('admin.layanan.index') }}">Layanan</a>
                                            </li>
                                            <li class="{{ Request::is('admin/reviews*') ? 'active' : '' }}">
                                                <a href="{{ route('admin.reviews.index') }}">Reviews</a>
                                            </li>
                                            <li class="{{ Request::is('admin/laporan*') ? 'active' : '' }}">
                                                <a href="{{ route('admin.laporan.index') }}">Laporan</a>
                                            </li>
                                        @break

                                        @case('kasir')
                                            <li class="{{ Request::is('kasir') ? 'active' : '' }}">
                                                <a href="{{ route('kasir.menu') }}">Dashboard</a>
                                            </li>
                                            <li class="{{ Request::is('kasir/pesanan/create') ? 'active' : '' }}">
                                                <a href="{{ route('kasir.pesanan.create') }}">Pesanan</a>
                                            </li>
                                        @break

                                        @default
                                            <li class="{{ Request::is('pelanggan') ? 'active' : '' }}">
                                                <a href="{{ route('pelanggan.menu') }}">Dashboard</a>
                                            </li>
                                            <li class="{{ Request::is('pelanggan/profil') ? 'active' : '' }}">
                                                <a href="{{ route('pelanggan.profil') }}">Profil</a>
                                            </li>
                                            <li class="{{ Request::is('pelanggan/pesanan/my') ? 'active' : '' }}">
                                                <a href="{{ route('pelanggan.my') }}">Pesanan Saya</a>
                                            </li>
                                            <li class="{{ Request::is('pelanggan/review') ? 'active' : '' }}">
                                                <a href="{{ route('pelanggan.review') }}">Review</a>
                                            </li>
                                    @endswitch
                                    <li class="d-lg-none mt-10">
                                        <form action="{{ route('auth.logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="genric-btn danger">Keluar</button>
                                        </form>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="header-right d-none d-lg-block">
                @guest
                    <a href="{{ route('auth.login') }}" class="header-btn1">Masuk</a>
                    <a href="{{ route('auth.register') }}" class="header-btn2">Daftar</a>
                @endguest
                @auth
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="header-btn2 bg-danger border-0">Keluar</button>
                    </form>
                @endauth
            </div>
            <!-- Mobile Menu -->
            <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
