<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
                'name'=>'required|unique:categories|max:100|regex:/^[\w\s]*$/u',
                'slug'=>'required|unique:categories|max:150',
                'logoImg'=>'required|image',
        ];
    }

    public function messages()
    {
        return [
                'name.required'=>'Tên danh mục không được để trống',
                'name.unique'=>'Tên danh mục đã tồn tại',
                'name.regex'=>'Tên danh mục không được dùng ký tự đặc biệt',
                'name.max'=>'Tên danh mục không được vượt quá 100 kí tự',
                'slug.required'=>'Tên đường dẫn không được để trống',
                'slug.unique'=>'Tên đường dẫn đã tồn tại',
                'slug.max'=>'Tên đường dẫn không được vượt quá 150 kí tự',
                'logoImg.required'=>'Logo không được để trống',
                'logoImg.image'=>'Không đúng định dạng ảnh',
            ];
    }

}
