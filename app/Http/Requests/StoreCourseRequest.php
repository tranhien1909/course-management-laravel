<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'id' => 'required|unique:courses,id',
            'course_name' => 'required|string|max:255',
            'level' => 'required|in:A1,B1,C1',
            'lessons' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Bạn chưa nhập mã khóa học',
            'id.unique' => 'Mã khóa học đã tồn tại. Hãy điền mã khác',
            'course_name.required' => 'Bạn chưa nhập tên khóa học',
            'level.required' => 'Bạn chưa chọn cấp độ',
            'lessons.required' => 'Bạn chưa nhập số bài học',
            'price.required' => 'Bạn chưa nhập giá khóa học',
            'avatar.image' => 'File tải lên phải là hình ảnh',
            'avatar.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif'
        ];
    }
}
