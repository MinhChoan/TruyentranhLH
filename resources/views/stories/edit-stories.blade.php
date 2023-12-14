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
                                <input type="text" class="form-control" name="ten_khac" value="{{ $truyen->DifferentName }}">
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
                                        <option value="{{ $category->CategoryID }}" {{ in_array($category->CategoryID, $selectedCategories) ? 'selected' : '' }}>
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
                                        <option value="{{ $author->id }}" {{ in_array($author->id, $selectedAuthors) ? 'selected' : '' }}>
                                            {{ $author->AuthorName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Thêm trường trạng thái --}}
                            <div class="select-group">
                                <label for="chon-trang-thai">Trạng thái</label>
                                <select id="chon-trang-thai" name="trang_thai" class="form-control">
                                    <option value="Đang tiến hành" {{ $truyen->Status == 'Đang tiến hành' ? 'selected' : '' }}>Đang tiến hành</option>
                                    <option value="Đang tạm ngưng" {{ $truyen->Status == 'Đang tạm ngưng' ? 'selected' : '' }}>Đang tạm ngưng</option>
                                    <option value="Đã hoàn thành" {{ $truyen->Status == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                                </select>
                            </div>

                            <div class="text-center">
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
                            <button type="button" class="btn btn-outline-success"><i class="bi bi-plus-square"></i> Thêm
                                chương</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Content for the second card -->
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
                                    <button type="button" class="btn btn-outline-success"><i class="bi bi-image-alt"></i>
                                        Đổi hình</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Content for the third card -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-blockquote-right"></i> Thông tin thêm</h4>
                            </div>
                            <div class="card-body">
                                <div class="select-group">
                                    <label for="title">Chủ sở hữu</label>
                                    <select id="chon-chu-so-huu" name="chu_so_huu[]" class="form-control" multiple>
                                        {{-- @foreach ($getChuSoHuu as $owner)
                                            <option value="{{ $owner->id }}" {{ in_array($owner->id, $selectedOwners) ? 'selected' : '' }}>
                                                {{ $owner->OwnerName }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
