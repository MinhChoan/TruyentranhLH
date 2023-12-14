@extends('admin.admin')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <div class="card">
        <div class="card-header">
            <div class="ds-header d-flex justify-content-between align-items-center">
                <div class="header-left">
                    <h4 class="mb-0"><i class="bi bi-list mb-0"></i> Danh sách thành viên</h4>
                </div>
                <div class="header-right">
                    <div class="mgnBtn">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!--  Bảng hiển thị dữ liệu -->
        <div class="table-responsive" style="width:100%">
            <table id="memberTable" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th class="col-1">User ID</th>
                        <th>Tên thành viên</th>
                        <th>Email</th>
                        {{-- <th>Vai trò</th> --}}
                        <th class="col-3">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if (session('error'))
                        <script>
                            alert("{{ session('error') }}");
                        </script>
                    @elseif (session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                    @endif
                    <!-- Dữ liệu sẽ được thêm vào đây -->
                    @foreach ($member as $thanhvien)
                        <tr>
                            <td>{{ $thanhvien->id }}</td>
                            <td>{{ $thanhvien->username }}</td>
                            <td>{{ $thanhvien->email }}</td>
                            {{-- <td>{{ $thanhvien->usertype }}</td> --}}
                            {{-- <td> 
                                @switch($thanhvien->usertype)
                                @case('admin')
                                    Quản trị viên
                                    @break
                                @case('user')
                                    Thành viên
                                    @break
                                @case('ban')
                                    Cấm khỏi trang
                                    @break
                                @default
                                    Không xác định
                                @endswitch
                            </td> --}}
                            <td class="text-center">
                                <form method="post" action="{{ route('thay-doi-quyen-han', $thanhvien->id) }}" class="my-3 d-flex">
                                    @csrf
                                    @method('put')
                                    <div class="flex-grow-1 me-2">
                                        <select class="form-select" name="usertype" id="usertype">
                                            @foreach(['admin' => 'Quản trị viên', 'user' => 'Thành viên', 'ban' => 'Cấm khỏi trang'] as $value => $label)
                                                <option value="{{ $value }}" {{ $thanhvien->usertype == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </form>
                                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        new DataTable('#memberTable', {
            pagingType: 'full_numbers',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Vietnamese.json'
                }
            });
    </script>

    <script>
        var categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));

        function toggleCategoryForm() {
            categoryModal.toggle();
        }
    </script>
@endsection
