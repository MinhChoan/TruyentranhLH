<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('index');
})->name('index');



Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', 'AuthController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{username}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
    //CategoryRoute
    Route::get('/admin/the-loai',[CategoryController::class,'index'])->name('the-loai');
    Route::post('/admin/the-loai/tao-the-loai',[CategoryController::class,'create'])->name('tao-the-loai');
    Route::delete('/admin/the-loai/xoa-the-loai/{id}', [CategoryController::class, 'destroy'])->name('xoa-the-loai');
    //AuthorRoute
    Route::get('/admin/tac-gia',[AuthorController::class,'index'])->name('tac-gia');
    Route::post('/admin/tac-gia/tao-tac-gia',[AuthorController::class,'create'])->name('tao-tac-gia');
    Route::delete('/admin/tac-gia/xoa-tac-gia/{id}', [AuthorController::class, 'destroy'])->name('xoa-tac-gia');
    //StoriesRoute
    Route::get('/admin/danh-sach-truyen/', [StoriesController::class, 'index'])->name('danh-sach-truyen');
    Route::post('/admin/danh-sach-truyen/tao-truyen', [StoriesController::class, 'create'])->name('tao-truyen');
    Route::delete('/admin/danh-sach-truyen/xoa-truyen/{id}', [StoriesController::class, 'destroy'])->name('xoa-truyen');
    Route::match(['get', 'put', 'post'], '/admin/danh-sach-truyen/sua-truyen/{title}', [StoriesController::class, 'edit'])->name('sua-truyen');
    Route::put('/admin/danh-sach-truyen/sua-truyen/{title}', [StoriesController::class, 'update'])->name('admin.cap-nhat-truyen');
    //UserRoute
    Route::get('/admin/thanh-vien', [UserController::class,'index'])->name('thanh-vien');
    Route::put('/admin/thanh-vien/{id}/thay-doi-quyen-han', [UserController::class, 'roles'])->name('thay-doi-quyen-han');


    Route::get('/admin/bao-loi-truyen', [AdminController::class,'baoLoiTruyen'])->name('bao-loi-truyen');
    Route::get('/admin/nhom-dich', [AdminController::class,'nhomDich'])->name('nhom-dich');
    Route::get('/admin/thong-ke', [AdminController::class,'thongKe'])->name('thong-ke');
    Route::get('/admin/bao-loi-web', [AdminController::class,'baoLoiWeb'])->name('bao-loi-web');
    Route::get('/admin/yeu-cau', [AdminController::class,'yeuCau'])->name('yeu-cau');
    Route::get('/admin/bao-loi', [AdminController::class,'baoLoi'])->name('bao-loi');
    Route::get('/admin/thong-bao', [AdminController::class,'thongBao'])->name('thong-bao');
    Route::get('/admin/tuy-chinh', [AdminController::class,'tuyChinh'])->name('tuy-chinh');

    Route::get('/upload', [ImageController::class, 'showForm']);
    Route::post('/upload', [ImageController::class, 'upload']);

});

require __DIR__.'/auth.php';

Route::get('/truyen-tranh/{title}', [StoriesController::class, 'show'])->name('truyen-tranh');

// routes/web.php;

Route::middleware(['auth'])->group(function () {
    // ... các routes khác

    Route::post('/profile/avatar/upload', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
});

