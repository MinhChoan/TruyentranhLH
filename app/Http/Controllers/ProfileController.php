<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show($username): View
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            // Handle the case where no user with the given username exists
            abort(404);
        }

        return view('profile.show', compact('user'));
    }

public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = $request->user();

    // Xóa ảnh cũ trước khi tải lên ảnh mới
    if ($user->avatar) {
        Storage::delete($user->avatar);
    }

    // Lưu ảnh mới vào public/storage/avatars
    $avatarPath = $request->file('avatar')->store('avatars', 'public');

    // Cập nhật đường dẫn avatar trong cơ sở dữ liệu
    $user->update([
        'avatar' => $avatarPath,
    ]);

    return redirect()->route('profile.show', ['username' => $user->username])->with('status', 'avatar-uploaded');
}

}
