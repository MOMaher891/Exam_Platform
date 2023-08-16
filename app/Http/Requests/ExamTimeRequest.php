<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamTimeRequest extends FormRequest
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
            //
            'center_id'=>'required',
            // 'exam_id'=>'required',
            'from'=>'required|array',
            'to'=>'required|array',
            'num_of_observe'=>'required|array'
        ];
    }
}
