<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainCourseRequest extends FormRequest
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
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',
            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'course_id.required' => 'اختيار الكورس مطلوب',
            'course_id.exist' => 'يجب اختيار الكورس من قائمة الكورسات',
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'السعر يجب أن يكون رقمًا.',
            'price.min' => 'السعر لا يجب أن يكون سالبًا.',
            'start_date.required' => 'تاريخ البداية مطلوب.',
            'start_date.date' => 'تاريخ البداية يجب أن يكون تاريخًا صالحًا.',
            'end_date.required' => 'تاريخ النهاية مطلوب.',
            'end_date.date' => 'تاريخ النهاية يجب أن يكون تاريخًا صالحًا.',
            'end_date.after_or_equal' => 'تاريخ النهاية يجب أن يكون بعد أو يساوي تاريخ البداية.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'الاسم',
            'description' => 'الوصف',
            'price' => 'السعر',
            'start_date' => 'تاريخ البداية',
            'end_date' => 'تاريخ النهاية',
        ];
    }   
}
