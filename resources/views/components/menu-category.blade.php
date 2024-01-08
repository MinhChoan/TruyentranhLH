<style>
    .wide-dropdown {
        width: 700px;
        height: 460px;
    }
</style>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-book-fill"></i> Thể loại
    </a>
    <div class="dropdown-menu wide-dropdown" aria-labelledby="navbarDropdown">
        <div class="container text-center">
            <div class="row row-cols-sm-2 row-cols-md-4">
                @foreach ($theloai as $theloai)
                    <div class="row row-cols-4 ">
                        <a class="dropdown-item" href="{{ route('the-loai', ['categoryName' => $theloai->CategoryName]) }}">
                            {{ $theloai->CategoryName }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>