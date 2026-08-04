<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            "name" => ["required", "string", "max:256"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"]
        ];
    }
    public function messages()
    {
        return [
            // name
            "name.required" => "name field is required!",
            "name.string" => "name must be string",
            "name.max" => "name can not be greated than 255 letters",
            // email
            "email.required" => "email is required",
            "email.email" => "this is invalid email",
            "email.unique" => "this email is already used",
            // password
            // "password.required" => "password is required",
            // "password.confirmed" => "confirm password field dose not match the password field  ",
            // "password.password" => "this is a weak password"

        ];
    }
}
