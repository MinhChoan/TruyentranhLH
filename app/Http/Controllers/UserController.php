<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = User::select('id', 'username', 'email', 'usertype')->get();
        return view('admin.components.thanh-vien', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function roles(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'User not found');
        }

        // Validate the request data
        $request->validate([
            'usertype' => 'required|in:admin,user,ban',
        ]);

        // Update the usertype
        $user->usertype = $request->input('usertype');
        $user->save();

        return redirect()->back();
    }
}
