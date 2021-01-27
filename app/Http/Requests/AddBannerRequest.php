<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBannerRequest extends FormRequest
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
            'name'=>'unique:banners|max:100|regex:/^[\w\s]*$/u|nullable',
            'title'=>'max:150',
            'link'=>'max:150',
            'image'=>'required|image',
        ];
    }

    public function messages(){
        return [
            // 'name.unique'=>'Tên banner đã tồn tại',
            'name.max'=>'Tên banner không được quá 100 ký tự',
            'name.regex'=>'Tên banner không được dùng ký tự đặc biệt',
            'title.unique'=>'Tên tiêu đề đã tồn tại',
            'title.max'=>'Tên tiêu đề không được quá 150 ký tự',
            'link.unique'=>'Liên kết không được quá 150 ký tự',
            'image.required'=>'Bạn phải chọn ảnh',
            'image.image'=>'Ảnh không đúng định dạng',
        ];
    }
}



