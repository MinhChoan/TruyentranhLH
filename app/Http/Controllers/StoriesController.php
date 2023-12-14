<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;
use App\Models\Author;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Modify the query to include the order by statement
    $truyen = Story::select('StoryID', 'StoriesCover', 'Title', 'Content')
        ->orderByDesc('Updated_at') // Add this line to order by updated_at in descending order
        ->get();

    // Strip HTML tags and replace &nbsp; in the 'Content' field
    foreach ($truyen as $story) {
        $story->Content = str_replace('&nbsp;', ' ', strip_tags($story->Content));
    }

    return view('admin.components.danh-sach-truyen', compact('truyen'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         // Validate form data
        $validatedData = $request->validate([
            'stories_name' => 'required|string|max:100',
        ]);

        // Create a new category
        $stories = new Story();
        $stories->Title = $validatedData['stories_name'];
        $stories->Content = "";
        $stories->save();

        // Redirect back or do something else
        return redirect()->back()->with('success', 'Thể loại đã được thêm thành công!');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($title)
    {
        // Tìm truyện theo Title cùng với thông tin danh mục
        $story = Story::where('Title', $title)->first();

        if (!$story) {
            // Xử lý khi không tìm thấy truyện
            abort(404);
        }

        // Lấy thông tin cần hiển thị
        $title = $story->Title;
        $differentName = $story->DifferentName;
        $categories = explode(', ', $story->Category);
        $author = $story->Author;
        $content = $story->Content;
        dd($categories);

        // Truyền thông tin truyện vào view
        return view('stories.truyen-tranh', compact('title', 'differentName', 'categories', 'author', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $title)
{
    $getTheLoai = Category::all();
    $getTacGia = Author::all();
    $truyen = Story::where('Title', $title)->first();

    // Lấy ID của các tác giả đã được chọn cho truyện
    $selectedAuthors = $truyen->author ? $truyen->author->pluck('id')->toArray() : [];
    // Lấy ID của các thể loại đã được chọn cho truyện
    $selectedCategories = $truyen->categories->pluck('CategoryID')->toArray();
    

    return view('stories.edit-stories', compact('truyen', 'getTheLoai', 'getTacGia', 'selectedAuthors', 'selectedCategories'));
}


public function update(Request $request, $title)
    {
        // Validate dữ liệu nếu cần thiết
        $request->validate([
            'ten_truyen' => 'required|string|max:255',
            'ten_khac' => 'nullable|string|max:255',
            'noi_dung' => 'nullable|string',
            'the_loai' => 'nullable|array',
            'tac_gia' => 'nullable|array',
            'trang_thai' => 'nullable|string|in:Đang tiến hành,Đang tạm ngưng,Đã hoàn thành',
        ]);

        // Lấy thông tin từ request
        $tenTruyen = $request->input('ten_truyen');
        $tenKhac = $request->input('ten_khac');
        $noiDung = $request->input('noi_dung');
        $theLoai = $request->input('the_loai');
        $tacGia = $request->input('tac_gia');
        $trangThai = $request->input('trang_thai');

        // Lấy đối tượng Story từ cơ sở dữ liệu
        $truyen = Story::where('Title', $title)->first();

        // Cập nhật thông tin
        $truyen->Title = $tenTruyen;
        $truyen->DifferentName = $tenKhac;
        $truyen->Content = $noiDung;
        $truyen->Status = $trangThai;
        // ... Cập nhật các trường khác tương tự

        // Lưu thông tin cập nhật vào cơ sở dữ liệu
        $truyen->save();

        // Cập nhật thể loại của truyện
        $truyen->categories()->sync($theLoai);

        // Cập nhật tác giả của truyện
        // $truyen->authors()->sync($tacGia);

        // Redirect hoặc thực hiện các công việc khác sau khi cập nhật thành công
        return redirect()->route('danh-sach-truyen')->with('success', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $StoryID)
    {
        $story = Story::find($StoryID);
    
        // Check if the category exists
        if (!$story) {
            return redirect()->back()->with('error', 'Thể loại không tồn tại.');
        }
    
        // Delete the category
        $story->delete();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Thể loại đã được xóa thành công.');
    }
    
}
