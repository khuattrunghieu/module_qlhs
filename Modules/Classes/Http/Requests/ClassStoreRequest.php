<?php

namespace Modules\Classes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'school' => [
                'required',
            ]
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Tên không để trống',
            'school.required'=>'Vui lòng chọn trường học',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
