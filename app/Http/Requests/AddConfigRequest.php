<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddConfigRequest extends FormRequest
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
            'fileLogo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone'=>'required',
            'address'=>'required',
            'email'=>'required',
            'bottom_footer'=>'required'
        ];
    }
    public function messages(){
        return [

            'fileLogo.mimes'=>'Logo không đúng định dạng',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'email.required'=>'Bạn chưa nhập email',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'fileLogo.required'=>'Bạn chưa chọn logo',
            'bottom_footer.required'=>'Bạn chưa nhập nội dung',
        ];
    }
}
