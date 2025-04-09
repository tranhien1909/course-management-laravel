<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
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
            'class_id' => 'required|string|max:255|unique:classes,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'class_id.required' => 'Mã lớp học là bắt buộc.',
            'class_id.unique' => 'Mã lớp học đã tồn tại.',
            'course_id.required' => 'Vui lòng chọn khoá học.',
            'course_id.exists' => 'Khóa học không tồn tại.',
            'teacher_id.required' => 'Giảng viên là bắt buộc.',
            'teacher_id.exists' => 'Giảng viên không tồn tại.',
            'start_date.required' => 'Ngày khai giảng là bắt buộc.',
            'start_date.date' => 'Ngày khai giảng phải là một ngày hợp lệ.',
            'description.max' => 'Mô tả không được dài quá 255 ký tự.',
        ];
    }
}
