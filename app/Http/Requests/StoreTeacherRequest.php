<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'gender' => 'required|in:Nam,Nữ',
            'fullname' => 'required',
            'address' => 'nullable',
            'birthday' => 'required|date',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',

            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'joining_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng định dạng. Ví dự: abc@gmail.com',
            'password.required' => 'Bạn chưa nhập password',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'password.min' => 'Password phải có ít nhất 6 ký tự'
        ];
    }
}
