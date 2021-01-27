<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Post_new_passRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   return true;
        
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
            'token' => 'required|numeric',
            'new_password' => 'required|max:50|min:6',
            'new_password_confirmation'=>'required|same:new_password'
        ];
        
    }
    public function messages(){
        return [
            'email.required'=>'vui lòng nhập mail của bạn',
            'email.email'=>'email không đúng định dạng',
            'token.required'=>'Vui lòng nhập mã được gửi vào mail của bạn',
            'token.numeric'=>'vui lòng nhập mã xác nhận là số',
            'new_password.required'=>'Vui lòng nhập mật khẩu mới',
            'new_password.max'=>'Mật khẩu không được vượt quá 50 ký tự',
            'new_password.min'=>'Mật khẩu không được ít hơn 6 ký tự',
            'new_password_confirmation.required'=>'Nhập lại mật khẩu mới',
            'new_password_confirmation.same'=>'Mật khẩu không trùng khớp'
        ];
    }
}
