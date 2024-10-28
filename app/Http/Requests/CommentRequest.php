<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "rating" => "required",
            "user_name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:6",
            "comment_content" => "required|max:255",
        ];
    }

    public function messages()
    {
        return [
            "rating.required" => "Vui lòng chọn giá trị!",
            "user_name.required" => "Vui lòng không bỏ trống!",
            "email.required" => "Vui lòng không bỏ trống!",
            "email.unique" => "Địa chỉ email đã tồn tại! Vui lòng đăng nhập!",
            "password.required" => "Vui lòng không bỏ trống!",
            "password.min" => "Mật khẩu từ 6 ký tự trở lên!",
            "comment_content.required" => "Vui lòng không bỏ trống!",
            "comment_content.max" => "Nội dung quá dài!",
        ];
    }
}
