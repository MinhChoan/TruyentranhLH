<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link href="{{ url('css/app.css') }}" rel="stylesheet">
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('favicon.ico') }}" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                TruyentranhLH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">

                    <x-menu-category />
                    
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-bar-chart-fill"></i> Xếp hạng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-clock-fill"></i> Lịch sử</a>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Tìm kiếm" aria-label="search">
                        <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>


                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus-fill"></i>
                                Đăng ký</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-door-open-fill"></i>
                                    Đăng nhập</a>
                            </li>
                        @endif
                    @else
                    <div class="nav-item dropdown">
                        <button type="button" class="btn btn-outline-light" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                            <span class="badge badge-light">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationButton">
                            <a class="dropdown-item" href="#">New notification 1</a>
                            <a class="dropdown-item" href="#">New notification 2</a>
                            <a class="dropdown-item" href="#">New notification 3</a>
                        </div>
                    </div>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-vcard-fill"></i> {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.show', ['username' => Auth::user()->username]) }}"><i class="bi bi-person-lines-fill"></i> Trang cá nhân</a></li>

                                @if (Auth::user()->usertype == 'admin')
                                    <li><a class="dropdown-item" href="{{ url('admin') }}"><i class="bi bi-database-fill-gear"></i>
                                    Quản lý</a></li>
                                @else
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark-fill"></i> 
                                    Truyện đã lưu</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item logout-button"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-left"></i> Đăng xuất
                                    </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>