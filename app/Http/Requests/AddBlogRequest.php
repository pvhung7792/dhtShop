<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title'=> 'required|unique:blogs|max:100',
            'fileImage'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages(){
        return [
            'title.unique'=>'Tên danh mục tin tức đã tồn tại',
            'title.required'=>'Tên tin tức không được để trống',
            'fileImage.required'=>'File ảnh không được để trống',
            'fileImage.mines'=>'File ảnh không đúng định dạng',
            'fileImage.max'=>'File ảnh không được quá 2MB',
        ];
    }
}
