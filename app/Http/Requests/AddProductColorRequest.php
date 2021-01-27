<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductColorRequest extends FormRequest
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
        // $a = ['fileImage.*'=>'count:5'];

        // dd($a);
        return [
            'fileLogo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage.*'=>'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileImage'=>'max:5',

            'name'=>'required|max:200|regex:/^[\w\s]*$/u',
        ];
        // dd(request());
    }
    public function messages(){
        return [
            'fileLogo.mimes'=>'Logo không đúng định dạng',
            'fileLogo.required'=>'Bạn chưa chọn logo',
            'fileImage.mimes'=>'Ảnh không đúng định dạng',
            'fileImage.max'=>'Không upload quá 5 ảnh',
            'name.required'=>'Bạn chưa nhập tên màu',
            'name.unique'=>'Màu sắc đã tồn tại',
        ];
    }
}
