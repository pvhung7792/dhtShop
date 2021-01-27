<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogCateRequest extends FormRequest
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
            'name'=> 'required|unique:blog_cates|max:100|nullable',
        ];
    }
    public function messages(){
        return [
            'name.unique'=>'Tên danh mục tin tức đã tồn tại',
            'name.required'=>'Tên danh mục tin tức không được để trống',
        ];
    }
}
