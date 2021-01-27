<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;


class AddProductRequest extends FormRequest
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
            'name'=>'required|unique:products|max:200|regex:/^[\w\.\-\s]*$/u',
            'slug'=>'required|unique:products',
            'fileImage'=>'required|image',
        ];
    }

    public function messages()
    {
        return 
        [
        'name.required'=>'Tên sản phẩm không được để trống',
        'name.unique'=>'Tên sản phẩm đã tồn tại',
        'name.max'=>'Tên sản phẩm không được vượt quá 200 ký tự',
        'name.regex'=>'Tên sản phẩm không được dùng ký tự đặc biệt',
        'slug.required'=>'Đường dẫn không được để trống',
        'slug.unique'=>'Đường dẫn đã tồn tại',
        'fileImage.required'=>'Vui lòng chọn ảnh',
        'fileImage.image'=>'Ảnh không đúng định dạng(jpg,jpeg,png,gif)',
        ];
    }
}
