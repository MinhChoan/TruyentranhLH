<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;
use App\Models\Author;
use App\Models\Storiescategory;
use App\Models\Storiesauthor;
use App\Models\User;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $truyen = Story::select('StoryID', 'StoriesCover', 'Title', 'Content', 'Status', 'Created_at', 'Updated_at')
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
    public function show(string $title)
    {
        // Tìm truyện theo Title cùng với thông tin danh mục và tác giả
        $story = Story::where('Title', $title)->first();

        if (!$story) {
            // Xử lý khi không tìm thấy truyện
            abort(404);
        }

        // Lấy thông tin danh mục từ bảng storiescategory
        $storiesCategories = Storiescategory::where('StoryID', $story->StoryID)->get();

        if (!$storiesCategories->isEmpty()) {
            // Lấy thông tin chi tiết của danh mục từ bảng category
            $categoryNames = $storiesCategories->map(function ($storiesCategory) {
                $categoryInfo = Category::find($storiesCategory->CategoryID);
                return $categoryInfo ? $categoryInfo->CategoryName : null;
            })->filter()->implode(', ');
        } else {
            $categoryNames = 'Không có danh mục';
        }

        // Lấy thông tin tác giả từ bảng storiesauthor
        $storiesAuthors = Storiesauthor::where('StoryID', $story->StoryID)->get();

        if (!$storiesAuthors->isEmpty()) {
            // Lấy tên tác giả từ bảng author
            $authorNames = $storiesAuthors->map(function ($storiesAuthor) {
                $authorInfo = Author::find($storiesAuthor->AuthorID);
                return $authorInfo ? $authorInfo->AuthorName : null;
            })->filter()->implode(', ');
        } else {
            $authorNames = 'Không có tác giả';
        }
        $chapters = $story->chapters()->orderBy('Created_at', 'asc')->get();
        // Lấy thông tin cần hiển thị
        $title = $story->Title;
        $differentName = $story->DifferentName;
        $content = $story->Content;
        $cover = $story->StoriesCover;
        $status = $story->Status;

        // Truyền thông tin truyện, danh mục và tác giả vào view
        return view('stories.truyen-tranh', compact('title', 'differentName', 'categoryNames', 'authorNames', 'content', 'chapters', 'cover', 'status'));
    }


    public function edit(string $title)
    {
        $getTheLoai = Category::all();
        $getTacGia = Author::all();
        $truyen = Story::where('Title', $title)->first();

        // Lấy ID của các tác giả đã được chọn cho truyện
        $selectedAuthors = $truyen->authors->pluck('AuthorID')->toArray();
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
        $truyen->authors()->sync($tacGia);
        $this->uploadImage($request, $title);

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

    public function searchByTitle(Request $request)
    {
        $keyword = $request->input('keyword');

        // Sử dụng phương thức tìm kiếm theo tiêu đề
        $results = Story::searchByTitle($keyword)->get();

        // Truyền kết quả và từ khóa vào view
        return view('stories.search-results', compact('results', 'keyword'));
    }

    public function uploadImage(Request $request, $title)
{
    $request->validate([
        'image' => 'required|url', // Validate that the input is a valid URL.
    ]);

    // Lấy link hình ảnh từ request.
    $imageUrl = $request->input('image');

    // Lấy đối tượng Story từ cơ sở dữ liệu dựa trên tiêu đề truyện.
    $truyen = Story::where('Title', $title)->first();

    // Kiểm tra xem truyện có tồn tại không.
    if (!$truyen) {
        return redirect()->back()->with('error', 'Truyện không tồn tại.');
    }

    // Lưu link vào cột StoriesCover của bảng stories của truyện đang chỉnh sửa.
    $truyen->StoriesCover = $imageUrl;
    $truyen->save();

    return redirect()->back()->with('success', 'Image uploaded successfully');
}



}
