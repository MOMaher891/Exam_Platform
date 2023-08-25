<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamValidation extends FormRequest
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
            'date' => 'required|date',
            'show_date' => 'required|date',
            'price' => 'required|numeric|gt:0',
            'type' => 'required',
            'center_id' => 'array',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name field required',
            // 'category_id.required' => 'Name field required',
            'date.required' => 'Name field required',
            'price.required' => 'Name field required',
            'price.numeric' => "Price should be numeric",
            'price.gt' => "Price can't be zero",
            // 'name.unique' => ":Exam name already exist in database.",
            'date.date' => 'Date field should be date',
            'show_date.date' => 'Show date field should be date',
        ];
    }
}
