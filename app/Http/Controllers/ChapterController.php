<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::all();
        return view('chapters.index', compact('chapters'));
    }

    public function create()
    {
        return view('chapters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:255',
        ]);

        Chapter::create($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chương đã được thêm thành công.');
    }

    public function edit(Chapter $chapter)
    {
        return view('chapters.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:255',
        ]);

        $chapter->update($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chương đã được cập nhật thành công.');
    }
}
