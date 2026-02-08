<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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

            'name' => 'required|string|max:255|unique:students,name,' . $this->route('student'),
            'phone' => 'required|string|max:255|unique:students,phone,' . $this->route('student'),
            'active' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الطالب مطلوب',
            'name.unique' => 'اسم الطالب موجود بالفعل',
            'name.string' => 'اسم الطالب يجب أن يكون نصًا',
            'name.max' => 'اسم الطالب لا يجب أن يتجاوز 255 حرفًا',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'رقم الهاتف يجب أن يكون نصًا',
            'phone.max' => 'رقم الهاتف لا يجب أن يتجاوز 255 حرفًا',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.in' => 'حالة التفعيل غير صحيحة',
            'image.image' => 'الملف المرفوع يجب أن يكون صورة',
            'image.mimes' => 'صيغة الصورة غير مدعومة',
            'address.string' => 'العنوان يجب أن يكون نصًا',
            'address.max' => 'العنوان لا يجب أن يتجاوز 500 حرفًا',
            'notes.string' => 'الملاحظات يجب أن تكون نصًا',
            'notes.max' => 'الملاحظات لا يجب أن تتجاوز 255 حرفًا',
            'country_id.required' => 'البلد مطلوب',
            'country_id.exists' => 'البلد المحدد غير موجود',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'اسم الطالب',
            'phone' => 'رقم الهاتف',
            'active' => 'الحالة',
            'image' => 'صورة الطالب',
            'address' => 'العنوان',
            'notes' => 'الملاحظات',
            'country_id' => 'البلد',
        ];
    }
}
