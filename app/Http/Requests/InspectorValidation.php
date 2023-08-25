<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspectorValidation extends FormRequest
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
            'phone' => 'required|string|unique:observes,phone',
            'national_id' => 'required|numeric|unique:observes,national_id',
            'email' => 'required|email|unique:observes,email',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
            'confirm_password' => 'required|string|same:password|min:8',
            'nationality' => 'required|string',
            'job_title' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'img_personal' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
            'img_national' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
            'img_national_back' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
            'img_passport' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
            'img_certificate' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
            'img_certificate_good_conduct' => 'required|mimes:jpeg,png,pdf,jpg,word,excel',
        ];
    }

    public function messages()
    {
        return [
            'gender.in' => 'Gender should be male or female'
        ];
    }
}
