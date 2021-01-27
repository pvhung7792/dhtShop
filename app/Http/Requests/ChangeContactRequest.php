<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeContactRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'address'=>'required',
            'phone'=>'required|numeric'
        ];
    }
    public function messages(){
        return [
            'first_name.required'=>'Vui lòng không dể trống',
            'last_name.required'=>'Vui lòng không dể trống',
            'address.required'=>'Vui lòng không dể trống',
            'phone.required'=>'Vui lòng không dể trống',
            'phone.numeric'=>'sai định dạng',
            
            
        ];
    }
}
