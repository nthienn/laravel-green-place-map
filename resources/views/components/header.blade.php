<div class="header">
    <div class="header__navbar">
        <div class="header__logo">
            <a href="{{ URL('/') }}" class="header__logo-link">
                <img src="{{ asset('home/img/logo.png') }}" alt="" class="header__logo-img">
            </a>
        </div>

        <form method="GET" action="{{ route('search') }}">
            <div class="search-box">
                <input id="search" class="search-text" type="text" placeholder="Search..." name="key_word">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <ul class="header__navbar-list">
            <li class="header__navbar-item">
                <a href="{{ URL('/') }}" class="header__navbar-item-link">
                    <i class="fa-solid fa-house header__navbar-icon"></i>
                    Trang chủ
                </a>
            </li>
            @if (session()->has('id_user'))
                <li class="header__navbar-item">
                    <a href="{{ route('place.create') }}" class="header__navbar-item-link">
                        <i class="fas fa-fw fa-user-tie header__navbar-icon"></i>
                        Trở thành nhà cung cấp
                    </a>
                </li>
                <li class="header__navbar-item">
                    <a href="#" class="header__navbar-item-link">
                        <i class="fa-solid fa-user header__navbar-icon"></i>
                        {{ session()->get('name') }}
                    </a>
                    <ul class="header__navbar-subnav">
                        <li class="header__subnav-item">
                            <a href="{{ route('user.index') }}" class="header__subnav-item-link">
                                <i class="fa-solid fa-user-check header__navbar-icon"></i>
                                Thông tin cá nhân
                            </a>
                        </li>
                        @if (session()->get('id_role') == 1)
                            <li class="header__subnav-item">
                                <a href="{{ route('place.index') }}" class="header__subnav-item-link">
                                    <i class="fa-solid fa-tree header__navbar-icon"></i>
                                    Địa điểm xanh của bạn
                                </a>
                            </li>
                        @endif
                        <li class="header__subnav-item logout">
                            <a href="#" class="header__subnav-item-link" data-toggle="modal"
                                data-target="#logoutModal">
                                <i class="fa-solid fa-right-from-bracket header__navbar-icon"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="header__navbar-item">
                    <a href="{{ route('user.create') }}" class="header__navbar-item-link">
                        <i class="fa-solid fa-right-to-bracket header__navbar-icon"></i>
                        Đăng nhập
                    </a>
                </li>
                <li class="header__navbar-item">
                    <a href="{{ route('user.create') }}" class="header__navbar-item-link">
                        <i class="fa-solid fa-pen-to-square header__navbar-icon"></i>
                        Đăng ký
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng xuất?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc là muốn Đăng xuất không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>
