<header>
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
                                <li class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="{{ Request::is('about') ? 'active' : '' }}">
                                    <a href="{{ url('/about') }}">About</a>
                                </li>
                                <li class="{{ Request::is('services') ? 'active' : '' }}">
                                    <a href="{{ url('/services') }}">Services</a>
                                </li>
                                <li class="{{ Request::is('blog*') ? 'active' : '' }}">
                                    <a href="{{ url('/blog') }}">Blog</a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('/blog') }}l">Blog</a></li>
                                        <li><a href="{{ url('/blog/detail') }}">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                    <a href="{{ url('/contact') }}">Contact</a>
                                </li>
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
