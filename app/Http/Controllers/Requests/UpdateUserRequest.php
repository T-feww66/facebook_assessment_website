<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép người dùng gửi request
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'fullname' => 'required|string|max:100',
            'sdt' => 'nullable|string|max:10',
            'dia_chi' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.min' => 'Tên đăng nhập phải có ít nhất 3 ký tự.',
            'username.max' => 'Tên đăng nhập không được vượt quá 50 ký tự.',
            'fullname.required' => 'Vui lòng nhập họ và tên.',
            'fullname.max' => 'Họ và tên không được vượt quá 100 ký tự.',
        ];
    }
}
