<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\Storiesimage;



class ChapterController extends Controller
{
    public function index($title, $chapterNumber)
    {
        // Find the story with the specified title
        $story = Story::where('Title', $title)->first();

        // Handle the case where the story with the specified title is not found
        if (!$story) {
            return redirect()->back()->with('error', 'Story not found.');
        }

        // Find the chapter with the specified chapter number
        $chapter = $story->chapters()->where('ChapterNumber', $chapterNumber)->first();

        // Handle the case where the chapter with the specified chapter number is not found
        if (!$chapter) {
            return redirect()->back()->with('error', 'Chapter not found.');
        }

        // Get the next chapter
        $nextChapter = $story->chapters()->where('ChapterNumber', $chapterNumber + 1)->first();

        // Get the previous chapter
        $previousChapter = $story->chapters()->where('ChapterNumber', $chapterNumber - 1)->first();

        // Get the first chapter
        $firstChapter = $story->chapters()->orderBy('ChapterNumber')->first();

        // Get the last chapter
        $lastChapter = $story->chapters()->orderByDesc('ChapterNumber')->first();

        // Get the images associated with the chapter
        $images = $chapter->images()->orderBy('ImageNumber')->get();

        // Return the view and pass the chapter, next chapter, previous chapter, first chapter, last chapter, and images to it
        return view('stories.read-stories', compact('chapter', 'nextChapter', 'previousChapter', 'firstChapter', 'lastChapter', 'images'));
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

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('chapters.index')->with('success', 'Chương đã được xóa thành công.');
    }

    public function addChapter(Request $request, $title)
    {
        // Validate the form data
        $request->validate([
            'ten_chuong' => 'required|string',
            'noi_dung' => 'nullable|string',
            'link_anh' => 'required|string',
        ]);

        // Find the story with the specified title
        $story = Story::where('Title', $title)->first();

        // Handle the case where the story with the specified title is not found
        if (!$story) {
            return redirect()->back()->with('error', 'Story not found.');
        }

        // Find or create a chapter with the same title
        $chapter = $story->chapters()->firstOrCreate(
            ['Title' => $request->input('ten_chuong')],
            ['Content' => $request->input('noi_dung'), 'Created_at' => now()]
        );

        // Save images associated with the chapter
        $this->saveImages($story, $chapter, $request->input('link_anh'));

        // Redirect back to the page with a success message
        return redirect()->back()->with('success', $chapter->wasRecentlyCreated ? 'Chapter added successfully.' : 'Chapter updated successfully.');
    }

    public function show(string $title, string $chapterTitle)
{
    // Xác định truyện theo Title
    $story = Story::where('Title', $title)->first();

    if (!$story) {
        abort(404); // Xử lý khi không tìm thấy truyện
    }

    // Lấy chapter theo StoryID và ChapterTitle
    $chapter = Chapter::where('StoryID', $story->StoryID)
        ->where('Title', $chapterTitle)
        ->first();

    if (!$chapter) {
        abort(404); // Xử lý khi không tìm thấy chapter
    }

    // Lấy tất cả các ảnh của chapter và sắp xếp chúng theo ImageID
    $images = Storiesimage::where('ChapterID', $chapter->ChapterID)->orderBy('ImageID')->get();

    // Lấy tổng số chapters để kiểm tra nút chuyển trang
    $totalChapters = Chapter::where('StoryID', $story->StoryID)->count();

    $firstChapter = Chapter::where('StoryID', $story->StoryID)->orderBy('ChapterNumber')->first();
    $lastChapter = Chapter::where('StoryID', $story->StoryID)->orderBy('ChapterNumber', 'desc')->first();  

    // Truyền thông tin chapter, ảnh, tổng số chapters, và các thông tin khác vào view
    $chapterInfo = [
        'chapter' => $chapter,
        'images' => $images,
        'title' => $title,
        'chapterTitle' => $chapterTitle,
        'story' => $story,
        'totalChapters' => $totalChapters,
        'firstChapter' => $firstChapter,
        'lastChapter' => $lastChapter,
    ];

    return view('stories.read-stories', compact('chapterInfo', 'story', 'firstChapter', 'lastChapter'));
}

private function saveImages($story, $chapter, $imageURLs)
{
    foreach (explode("\n", $imageURLs) as $imageURL) {
        // Save the image record
        $storiesimage = new Storiesimage([
            'StoryID' => $story->StoryID,
            'ChapterID' => $chapter->ChapterID,
            'ImageURL' => $imageURL,
        ]);
        $storiesimage->save();
    }
}

}
