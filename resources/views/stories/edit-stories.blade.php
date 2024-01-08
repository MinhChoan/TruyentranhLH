@extends('admin.admin')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <div class="edit">
        <div class="row">
            {{-- Bên trái --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="md-12"><i class="bi bi-info-square"></i> Chỉnh sửa thông tin</h4>
                        <div class="form-check form-switch ml-auto">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckHot"
                                name="truyen_hot" value="1" {{ $truyen->is_hot ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckHot">Truyện HOT</label>
                        </div>
                        {{-- <div class="form-check form-switch ms-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheck18"
                                name="truyen_18_plus" value="1" {{ $truyen->is_18_plus ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheck18">Truyện 18+</label>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cap-nhat-truyen', ['title' => $truyen->Title]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tên truyện</span>
                                </div>
                                <input type="text" class="form-control" name="ten_truyen" value="{{ $truyen->Title }}">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tên khác</span>
                                </div>
                                <input type="text" class="form-control" name="ten_khac"
                                    value="{{ $truyen->DifferentName }}">
                            </div>

                            <div class="form-group">
                                <label for="storyContent">Nội dung truyện:</label>
                                <textarea id="editor" name="noi_dung" class="form-control">{{ $truyen->Content }}</textarea>
                            </div>

                            {{-- Thêm trường thể loại --}}
                            <div class="select-group">
                                <label for="chon-the-loai">Thể loại</label>
                                <select id="chon-the-loai" name="the_loai[]" class="form-control" multiple>
                                    @foreach ($getTheLoai as $category)
                                        <option value="{{ $category->CategoryID }}"
                                            {{ in_array($category->CategoryID, $selectedCategories) ? 'selected' : '' }}>
                                            {{ $category->CategoryName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Thêm trường tác giả --}}
                            <div class="select-group">
                                <label for="chon-tac-gia">Tác giả</label>
                                <select id="chon-tac-gia" name="tac_gia[]" class="form-control" multiple>
                                    @foreach ($getTacGia as $author)
                                        <option value="{{ $author->AuthorID }}"
                                            {{ in_array($author->AuthorID, $selectedAuthors) ? 'selected' : '' }}>
                                            {{ $author->AuthorName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Thêm trường trạng thái --}}
                            <div class="select-group">
                                <label for="chon-trang-thai">Trạng thái</label>
                                <select id="chon-trang-thai" name="trang_thai" class="form-control">
                                    <option value="Đang tiến hành"
                                        {{ $truyen->Status == 'Đang tiến hành' ? 'selected' : '' }}>Đang tiến hành</option>
                                    <option value="Đang tạm ngưng"
                                        {{ $truyen->Status == 'Đang tạm ngưng' ? 'selected' : '' }}>Đang tạm ngưng</option>
                                    <option value="Đã hoàn thành"
                                        {{ $truyen->Status == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                                </select>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="bi bi-floppy2-fill"></i> Lưu thông tin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="md-12"><i class="bi bi-info-square"></i> Danh sách chương</h4>
                        <div class="form-check form-switch ml-auto">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="bi bi-plus-circle"></i> Thêm chương
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                <span class="text-success">{{ $truyen->Title }}</span>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.them-chuong', ['title' => $truyen->Title]) }}" method="post">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tên chương</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="ten_chuong">
                                                </div>
                                            
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nội dung</span>
                                                    </div>
                                                    <textarea class="form-control" name="noi_dung"></textarea>
                                                </div>
                                            
                                                {{-- Additional textarea for multiple image URLs --}}
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Link ảnh</span>
                                                    </div>
                                                    <textarea class="form-control" name="link_anh" rows="5"></textarea>
                                                </div>
                                            
                                                {{-- Hidden input for ChapterID --}}
                                                <input type="hidden" name="chapter_id" value="{{ $chapter->ChapterID ?? null }}">
                                            
                                                <div class="text-center mt-3">
                                                    <button type="submit" class="btn btn-outline-success">
                                                        <i class="bi bi-floppy2-fill"></i> Lưu thông tin
                                                    </button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Tên chương</th>
                                    <th scope="col">Ngày đăng</th>
                                    <th scope="col">Lượt xem</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($truyen->chapters as $chapter)
                                    <tr>
                                        <td>{{ $chapter->Title }}</td>
                                        <td>
                                            {{ $chapter->Created_at }}
                                        </td>
                                        <td>{{ $chapter->view_count }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.sua-chuong', ['title' => $truyen->Title, 'chapter_id' => $chapter->ChapterID]) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Sửa
                                            </a>
                                            <a href="{{ route('admin.xoa-chuong', ['title' => $truyen->Title, 'chapter_id' => $chapter->ChapterID]) }}"
                                                class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Add a row for adding chapters -->
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- Bên phải --}}
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0"><i class="bi bi-image"></i> Hình ảnh</h4>
                                <div class="form-check form-switch ml-auto">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Đổi hình
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi hình</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('upload-image', $truyen->Title) }}" enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="image" id="inputGroupFile02">
                                                            <button type="submit" class="btn btn-primary">Tải lên</button>
                                                        </div>
                                                    </form>                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-success"
                                                        onclick="uploadImage()">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <img src="{{ $truyen->StoriesCover }}" alt="{{ $truyen->Title }}" class="img-fluid" style="width: 70%;">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-blockquote-right"></i> Thông tin thêm</h4>
                            </div>
                            <div class="card-body">
                                <div class="select-group">
                                    <label for="title">Chủ sở hữu</label>
                                    <select id="chon-chu-so-huu" name="chu_so_huu[]" class="form-control" multiple>
                                        @foreach ($getChuSoHuu as $owner)
                                            <option value="{{ $owner->id }}" {{ in_array($owner->id, $selectedOwners) ? 'selected' : '' }}>
                                                {{ $owner->OwnerName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        ['#chon-the-loai', '#chon-tac-gia', '#chon-trang-thai', '#chon-chu-so-huu'].forEach(function(element) {
            $(element).select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
