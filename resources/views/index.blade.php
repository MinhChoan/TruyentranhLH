<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/resetcss.css') }}" rel="stylesheet">
    <title>TruyentranhLH</title>
</head>

<body>
    <x-navbar />

    <div class="body">
        <div class="container bodycarousel">
            <!-- Carousel -->
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-fire"></i> Truyện nổi bật
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

        <main>
            <div class="container bodynewmanga">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Truyện mới cập nhật -->
                        <x-updated-stories />

                        <!-- Truyện mới đăng -->
                        {{-- <x-new-stories /> --}}
                    </div>
                    <div class="col-md-4">
                        
                        <!-- Lịch sử đọc truyện -->
                        <x-history />
                        
                        <!-- Bình luận gần đây -->
                        <x-recent-comment />

                    </div>
                </div>
            </div>
        </main>
    </div>

    </div>
    </div>
</body>
<x-footer />

</html>
