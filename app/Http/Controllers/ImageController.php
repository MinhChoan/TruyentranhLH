<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function saveImage(Request $request)
    {
        // Xử lý lưu đường dẫn hình ảnh
        // $request->input('image_link') chứa đường dẫn hình ảnh từ form

        return redirect()->back(); // hoặc chuyển hướng đến trang khác
    }

}