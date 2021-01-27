<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|regex:/(0)[0-9]{8,10}/',
            'address' => 'required|max:255',
            'password' => 'required|min:6|max:50|confirmed',
            'password_confirmation' => 'required',
        ];
        
    }
    public function messages(){
        return [
           'first_name.required'=>'Vui lòng không để trống',
            'first_name.max'=>'Tên không vượt quá 225 ký tự',
            'last_name.required'=>'Vui lòng không để trống',
            'last_name.max'=>'Tên không vượt quá 225 ký tự',
            'email.required'=>'Vui lòng không để trống',
            'email.unique'=>'Email đã được đăng ký, vui lòng nhập email khác',
            'email.max'=>'Email không vượt quá 225 ký tự',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'phone.regex'=>'Số điện thoại không đúng định dạng',
            'address.required'=>'không để trống',
            'address.max'=>'địa chỉ quá dài',
            'password.required'=>'không hợp lệ',
            'password.max'=>'không hợp lệ',
            'password.min'=>'không hợp lệ',
            'password_confirmation.required'=>'không hợp lệ',
            'password.confirmed'=>'Mật khẩu không khớp vui lòng nhập lại',
        ];
    }
}
