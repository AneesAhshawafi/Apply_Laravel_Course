<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'active' => 'required|in:0,1'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الكورس مطلوب',
            'name.string' => 'اسم الكورس يجب أن يكون نصًا',
            'name.max' => 'اسم الكورس لا يجب أن يتجاوز 255 حرفًا',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.in' => 'حالة التفعيل غير صحيحة',
        ];
    }   
    public function attributes()
    {
        return [
            'name' => 'اسم الكورس',
            'active' => 'حالة التفعيل',
        ];
    }   
}
