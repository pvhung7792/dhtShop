<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogCateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:100|unique:blog_cates,name,'.$this->id,
        ];
    }
    public function messages(){
        return [
            'name.unique'=>'Tên danh mục tin tức đã tồn tại',
            'name.required'=>'Tên danh mục tin tức không được để trống',
        ];
    }
}
