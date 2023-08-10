<?php

namespace App\Http\Requests\Center;

use Illuminate\Foundation\Http\FormRequest;

class CenterRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required|max:20|min:5',
            'address'=>'required',
            'time_ids'=>'required|array',
            'observer_num'=>'required',
            'user_id'=>'required'
        ];
    }
}
