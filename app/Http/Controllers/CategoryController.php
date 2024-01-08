<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Contracts\DataTable;
use App\Models\Story;
use App\Models\Storiescategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::select('CategoryID' ,'CategoryName')->get();
        return view('admin.components.the-loai', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         // Validate form data
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:30',
        ]);

        // Create a new category
        $category = new Category();
        $category->CategoryName = $validatedData['category_name'];
        $category->save();

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
    public function show(string $categoryName)
{
    // Tìm Category dựa trên CategoryName
    $category = Category::where('CategoryName', $categoryName)->first();

    if (!$category) {
        // Xử lý trường hợp không tìm thấy Category
        abort(404);
    }

    // Tìm các StoryID dựa trên CategoryID trong bảng storiescategory
    $storyIds = Storiescategory::where('CategoryID', $category->CategoryID)->pluck('StoryID');

    // Tìm truyện dựa trên các StoryID
    $truyen = Story::whereIn('StoryID', $storyIds)->get();

    return view('stories.category-stories', compact('category', 'truyen'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $CategoryID)
    {
        // Find the category by ID
        $category = Category::find($CategoryID);
    
        // Check if the category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Thể loại không tồn tại.');
        }
    
        // Delete the category
        $category->delete();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Thể loại đã được xóa thành công.');
    }
    
}
