<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller
{
    public function index()
    {
        $user = Auth::user();
//        $user = User::findOrFail($id);
        return view('profile.profile-client-user-shopx', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
//        $user = User::findOrFail($id);
        return view('profile.profile-client-user-shopx', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'gender' => 'required|string',
            'birthday' => 'required|date',
        ]);

        $user = Auth::user();
//        $user->update($request->only('name', 'email', 'phone', 'gender', 'birthday'));
        // Chỉ cập nhật các trường đã được yêu cầu
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        $user->save();

        return redirect()->route('profile')->with('success', 'User updated successfully!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png|max:1024',
        ]);
        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete('avatar/' . $user->avatar);
        }

        // Save new avatar
        $path = $request->file('avatar')->store('avatar', 'public');
        $user->avatar = basename($path);
        $user->save();
        return redirect()->back()->with('success', 'Avatar updated successfully');
    }
}
