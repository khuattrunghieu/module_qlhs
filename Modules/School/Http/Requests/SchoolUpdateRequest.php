<?php

namespace Modules\School\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolUpdateRequest extends FormRequest
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
                'max:100',
                'min:5',
            ],
            'address' => [
                'required',
                'min:20',
            ],
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Tên không để trống',
            'name.max'=>'Tên quá dài',
            'name.min'=>'Tên quá ngắn',
            'address.required'=>'Địa chỉ không để trống',
            'address.min'=>'Địa chỉ quá ngắn',
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
