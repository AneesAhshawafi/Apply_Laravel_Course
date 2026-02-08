<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrnCrsRequest extends FormRequest
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
            "student_id" => "required|exists:students,id",
            "enrolment_date" => "required",
        ];
    }

    public function messages()
    {
        return [    
            "student_id.required" => "يجب اختيار الطالب",
            "student_id.exists" => "الطالب غير موجود",
            "enrolment_date.required" => "يجب اختيار تاريخ التسجيل"
        ];
    }
    public function attributes(): array{
        return [
            "student_id" => "الطالب",
            "enrolment_date" => "تاريخ التسجيل"
        ];
    }
}
