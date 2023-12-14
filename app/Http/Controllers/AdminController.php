<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function baoLoiTruyen()
    {
        return view('admin.components.bao-loi-truyen', ['title' => 'Báo lỗi']);
    }



    public function nhomDich()
    {
        return view('admin.components.nhom-dich', ['title' => 'Nhóm dịch']);
    }

    public function thongKe()
    {
        $storyCount = Story::count();
        return view('admin.components.thong-ke', ['storyCount' => $storyCount]); 
    }
    public function baoLoiWeb()
    {
        return view('admin.components.thanh-vien', ['title' => 'Thành viên']);
    }
    public function yeuCau()
    {
        return view('admin.components.yeu-cau', ['title' => 'Yêu cầu']);
    }
    public function thongBao()
    {
        return view('admin.components.thong-bao', ['title' => 'Thông báo']);
    }
    public function tuyChinh()
    {
        return view('admin.components.tuy-chinh', ['title' => 'Tùy chỉnh']);
    }
    
}
