@extends('admin.admin')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <div class="card">
        <div class="card-header">
            <div class="ds-header d-flex justify-content-between align-items-center">
                <div class="header-left">
                    <h4 class="mb-0"><i class="bi bi-list mb-0"></i> Danh sách thể loại</h4>
                </div>
                <div class="header-right">
                    <div class="mgnBtn">
                        <button class="btn btn-outline-success btn-sm mr-1" data-bs-toggle="modal"
                            data-bs-target="#categoryNew">Thêm thể loại</button>

                        <div class="modal fade" id="categoryNew" tabindex="-1" aria-labelledby="categoryModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="categoryModalLabel">Thêm thể loại</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action=" {{ route('tao-the-loai') }} " method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="category_name" class="form-label">Tên thể loại:</label>
                                                <input type="text" class="form-control" id="category_name"
                                                    name="category_name" required>
                                            </div>
                                            <button type="submit" class="btn btn-success form-control">Xác nhận</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Thêm modal thông báo vào trang -->
                        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Thành công</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Thể loại đã được thêm thành công!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kiểm tra và hiển thị modal trong Blade view -->
                        @if(session('success'))
                            <script>
                                $('#successModal').modal('show');
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!--  Bảng hiển thị dữ liệu -->
            <table id="categoryTable" class="table table-bordered table-hover table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th>Thể loại</th>
                        <th class="col-2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu sẽ được thêm vào đây -->
                    @foreach ($category as $theloai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $theloai->CategoryName }}</td>
                            <td class="text-center">
                                {{-- Modal sửa --}}
                                {{-- <button class="btn btn-outline-warning btn-sm">Sửa</button> --}}


                                <!-- Modal xác nhận xóa -->
                                <button class="btn btn-outline-danger btn-sm form-control" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $theloai->CategoryID }}">
                                    Xóa
                                </button>
                                <div class="modal fade" id="deleteConfirmationModal{{ $theloai->CategoryID }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $theloai->CategoryID }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $theloai->CategoryID }}">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa thể loại này không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <!-- Add a link or form to trigger the delete action -->
                                                <form action="{{ route('xoa-the-loai', ['id' => $theloai->CategoryID]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-6L0G2DJT1j4ZLpL+f86OWKGNcY/kAI2c/i7tq5BJSZg=" crossorigin="anonymous"></script>    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8z+czSXYnHddYJAK01NNlNlfa4KzuzWIEaIbp5WTLqBhluL+veNLlRUq2N6t" crossorigin="anonymous"></script>    
    <script>
        //Modal
        var categoryModal = new bootstrap.Modal(document.getElementById('categoryNew'));

        function toggleCategoryForm() {
            categoryModal.toggle();
        }

        //Datatable
        new DataTable('#categoryTable', {
            pagingType: 'full_numbers',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Vietnamese.json'
                }
        });
    </script>
@endsection
