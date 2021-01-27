<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassUserRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|max:50|min:6',
            'new_password_confirmation'=>'required|same:new_password'
        ];
        
    }
    public function messages(){
        return [
            'old_password.required'=>'Vui lòng nhập mật khẩu đang sử dụng của bạn',
            'new_password.required'=>'Vui lòng nhập mật khẩu mới',
            'new_password.max'=>'Mật khẩu không được vượt quá 50 ký tự',
            'new_password.min'=>'Mật khẩu không được ít hơn 6 ký tự',
            'new_password_confirmation.required'=>'Nhập lại mật khẩu mới',
            'new_password_confirmation.same'=>'Mật khẩu không trùng khớp'
        ];
    }
}
