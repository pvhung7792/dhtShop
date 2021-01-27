<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductColorRequest extends FormRequest
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
            'fileLogo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'=>'required|max:200|regex:/^[\w\s]*$/u',
            'fileImage1'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage2'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage3'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage4'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage5'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages(){
        return [
            'fileLogo.mimes'=>'Logo không đúng định dạng',
            'fileImage1.mimes'=>'Logo không đúng định dạng',
            'fileImage2.mimes'=>'Logo không đúng định dạng',
            'fileImage3.mimes'=>'Logo không đúng định dạng',
            'fileImage4.mimes'=>'Logo không đúng định dạng',
            'fileImage5.mimes'=>'Logo không đúng định dạng',
            'name.required'=>'Bạn chưa nhập tên màu',
        ];
    }
}
