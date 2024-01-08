<x-navbar />
<p></p>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                <div class="card-body stories">
                    <div class="row">
                        
                        <div class="col-12 col-md-4 mb-2">
                            <div class="stories-cover mb-2">
                                <img src="{{ $cover }}"class="card-img-top" alt="...">
                            </div>
                            <div class="stories-read d-grid gap-2 col-12 mx-auto">
                                {{-- @foreach($chapters as $chapter)
                                    @if(isset($firstChapter) && $chapter->ChapterNumber != $firstChapter->ChapterNumber)
                                        <a href="{{ route('read-stories', ['title' => $title, 'chapterTitle' => $firstChapter->Title]) }}" class="btn btn-dark">Chương đầu</a>
                                    @endif
                            
                                    @if(isset($lastChapter) && $chapter->ChapterNumber != $lastChapter->ChapterNumber)
                                        <a href="{{ route('read-stories', ['title' => $title, 'chapterTitle' => $lastChapter->Title]) }}" class="btn btn-dark">Chương cuối</a>
                                    @endif
                                @endforeach --}}
                            </div>
                                              
                            
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="stories-title">
                                <span>
                                    <h4 class="fw-bold">{{ $title }}</h4>
                                </span>
                            </div>

                            <div class="stories-infomation mb-5">
                                <div class="stories-item">
                                    <span class="stories-name fw-bold">
                                        Tên khác:
                                    </span>
                                    <span class="stories-value">
                                        {{ $differentName }}
                                    </span>
                                </div>
                                <div class="stories-item">
                                    <span class="stories-name fw-bold">
                                        Thể loại:
                                    </span>
                                    <span class="stories-value">
                                        {{ $categoryNames }}
                                    </span>
                                </div>
                                <div class="stories-item">
                                    <span class="stories-name fw-bold">
                                        Tác giả:
                                    </span>
                                    <span class="stories-value">
                                        {{ $authorNames }}
                                    </span>
                                </div>
                                <div class="stories-item">
                                    <span class="stories-name fw-bold">
                                        Tiến độ truyện:
                                    </span>
                                    <span class="stories-value">
                                        {{ $status }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 bottom-features ">
                                <div class="side-features ">
                                    <div class="row justify-content-center ">
                                        <div class="col-md-2 col-2 feature-item text-center">
                                            <a href="" class="text-decoration-none text-dark">
                                                <span class="d-block feature-value display-6">
                                                    <i class="bi bi-hand-thumbs-up"></i>
                                                </span>
                                                <span class="block feature-name">20</span>
                                            </a>
                                        </div>
                                        <div class="col-md-2 col-2 feature-item text-center">
                                            <a href="" class="text-decoration-none text-dark">
                                                <span class="d-block feature-value display-6">
                                                    <i class="bi bi-hand-thumbs-down"></i>
                                                </span>
                                                <span class="block feature-name">20</span>
                                            </a>
                                        </div>
                                        <div class="col-md-2 col-2 feature-item text-center">
                                            <a href="" class="text-decoration-none text-dark">
                                                <span class="d-block feature-value display-6">
                                                    <i class="bi bi-suit-heart"></i>
                                                </span>
                                                <span class="block feature-name">20</span>
                                            </a>
                                        </div>
                                        <div class="col-md-2 col-2 feature-item text-center">
                                            <a href="" class="text-decoration-none text-dark">
                                                <span class="d-block feature-value display-6">
                                                    <i class="bi bi-star"></i>
                                                </span>
                                                <span class="block feature-name">20</span>
                                            </a>
                                        </div>
                                        <div class="col-md-2 col-2 feature-item text-center">
                                            <a href="" class="text-decoration-none text-dark">
                                                <span class="d-block feature-value display-6">
                                                    <i class="bi bi-share"></i>
                                                </span>
                                                <span class="block feature-name">20</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="card-body summary">
                    <div class="row">
                        <div class="value">
                            <h5>Tóm Tắt</h5>
                        </div>
                        <div class="content">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            </div>
            <div class="card mb-3">
                <div class="card-header text-bg-dark">
                    Danh sách chương
                </div>
                <div class="card-body chapter">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Chương</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ngày đăng</th>
                                <!-- Add more column headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chapters as $chapter)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-dark"
                                            href="{{ route('read-stories', ['title' => $title, 'chapterTitle' => $chapter->Title]) }}">
                                            {{ $chapter->Title }}
                                        </a>
                                    </td>
                                    <td>{{ $chapter->Content }}</td>
                                    <td>
                                        {{ $chapter->Created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-4">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                </div>
            </div>
        </div> --}}
    </div>

</div>
