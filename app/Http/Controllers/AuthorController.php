<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::select('AuthorID' ,'AuthorName')->get();
        return view('admin.components.tac-gia', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'author_name' => 'required|string|max:100',
        ]);

        // Create a new category
        $author = new Author();
        $author->AuthorName = $validatedData['author_name'];
        $author->save();

        // Redirect back or do something else
        return redirect()->back()->with('success', 'Tác giả đã được thêm thành công!');
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
    public function destroy(string $AuthorID)
    {
        $author = Author::find($AuthorID);
       
        if (!$author) {
            return redirect()->back()->with('error', 'Không tìm thấy tác giả!');
        }
        $author->delete();

        return redirect()->back()->with('success', 'Tác giả đã được xóa thành công!');
    }
}
