<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Contracts\DataTable;

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
    public function show(string $id)
    {
        //
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
