<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function showForm()
    {
        return view('upload-form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageData = file_get_contents($request->file('image')->getRealPath());

        $image = new Image;
        $image->image_data = $imageData;
        $image->save();

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
