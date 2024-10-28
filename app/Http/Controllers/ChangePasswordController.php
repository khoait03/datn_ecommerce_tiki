<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('layouts.profile_change_password', compact('user'));
    }

    public function update(Request $request)
    {
        $messages = [
            'old_password.required' => 'Mật khẩu cũ là bắt buộc.',
            'old_password.min' => 'Mật khẩu cũ phải có ít nhất 6 ký tự.',
            'old_password.max' => 'Mật khẩu cũ không được vượt quá 16 ký tự.',
            'new_password.required' => 'Mật khẩu mới là bắt buộc.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.max' => 'Mật khẩu mới không được vượt quá 16 ký tự.',
            'confirm_password.required' => 'Xác nhận mật khẩu mới là bắt buộc.',
            'confirm_password.same' => 'Xác nhận mật khẩu mới phải giống với mật khẩu mới.',
        ];
        $request->validate([
            'old_password' => 'required|min:6|max:16',
            'new_password' => 'required|min:6|max:16',
            'confirm_password' => 'required|same:new_password'
        ], $messages);

        $current_user = auth()->user();

        if (Hash::check($request->old_password, $current_user->password)) {

            $current_user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect('profile/edit')->with('success', 'Đã đổi mật khẩu thành công');
        } else {
            return redirect('profile/change-password')->with('error', 'Mật khẩu cũ không giống');
        }

    }
}
