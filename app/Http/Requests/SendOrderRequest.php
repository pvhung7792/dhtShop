<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendOrderRequest extends FormRequest
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
            'email'=>'required|email',
            'name'=>'required|regex:/^[\w\s]*$/u|max:50',
            'phone'=>'required|regex:/(0)[0-9]{8,10}/',
            'address'=>'required|max:150'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            'name.required'=>'Tên không được để trống',
            'address.required'=>'Địa chỉ không được để trống',
            'phone.required'=>'Số điện thoại không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'name.regex'=>'Tên không dùng ký tự đặc biệt',
            'address.max'=>'Địa chỉ không nhập quá 150 ký tự',
            'phone.regex'=>'Số điện thoại không đúng định dạng'
        ];
    }
}
