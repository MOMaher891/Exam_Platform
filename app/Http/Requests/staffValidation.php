<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class staffValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'phone' => 'required|string|max:20|min:5',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            // 'code'=>'required|unique:users,code,'.auth()->user()->id,
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "The name field required.",
            "email.unique" => "This email already exists",
            "email.required" => "The email field required.",
            "phone.required" => "The Telephone filed required.",
            "phone.max" => "Phone must be at least :20 characters.",
            "phone.min" => "Phone must be at least :5 characters.",
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least :8 characters.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special symbol.',
            "confirm_password.required" => "The confirm password filed required.",
            "confirm_password.same" => "Password not matching.",
            "role.required" => "Role filed required.",
        ];
    }
}
