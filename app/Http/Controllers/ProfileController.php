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
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.show', compact('user'));
        
    }


}
