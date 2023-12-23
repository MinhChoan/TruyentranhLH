<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-book-fill"></i> Thể loại
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <div class="container text-center row row-cols-4">
            <div class="row col-md-auto">
                @foreach ($theloai as $theloai)
                    <div class="col-4 col-md-2">
                        <a class="dropdown-item" href="{{ route('the-loai', ['categoryName' => $theloai->CategoryName]) }}">
                            {{ $theloai->CategoryName }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>