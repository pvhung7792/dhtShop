<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        // dd('sdasad');
        return [
                'name'=>'required|max:100|regex:/^[\w\s]*$/u|unique:categories,name,'.$this->id,
                'slug'=>'required|max:150|unique:categories,slug,'.$this->id,
                'logoImg'=>'image',
        ];
    }

    public function messages()
    {
        return [
                'name.required'=>'Tên danh mục không được để trống',
                'name.unique'=>'Tên danh mục đã tồn tại',
                'name.max'=>'Tên danh mục không được vượt quá 100 kí tự',
                'name.regex'=>'Tên danh mục không được dùng kí tự đặc biệt',
                'slug.required'=>'Tên đường dẫn không được để trống',
                'slug.unique'=>'Tên đường dẫn đã tồn tại',
                'slug.max'=>'Tên đường dẫn không được vượt quá 150 kí tự',
                'logoImg.image'=>'Không đúng định dạng ảnh',
            ];
    }
}
