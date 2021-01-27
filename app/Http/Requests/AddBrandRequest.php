<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddBrandRequest extends FormRequest
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
            // 'name'=>'required|max:100|regex:/^[\w\s]*$/u|unique:brands,name',
                'name'=>[
                    'required',
                    'max:100',
                    'regex:/^[\w\s]*$/u',
                    Rule::unique('brands', 'name')->where(function ($query){
                        return $query->where('category_id', request()->category_id);
                    }),
                ],
                'slug'=>[
                    'required',
                    'max:150',
                    Rule::unique('brands', 'slug')->where(function ($query){
                        return $query->where('category_id', request()->category_id);
                    }),
                ],
                'logoImg'=>'required|image',
        ];
    }

    public function messages()
    {
        return [
                'name.required'=>'Tên thương hiệu không được để trống',
                'name.unique'=>'Tên thương hiệu đã tồn tại',
                'name.max'=>'Tên thương hiệu không được vượt quá 100 kí tự',
                'name.regex'=>'Tên thương hiệu không được dùng kí tự đặc biệt',
                'slug.required'=>'Tên đường dẫn không được để trống',
                'slug.unique'=>'Tên đường dẫn đã tồn tại',
                'slug.max'=>'Tên đường dẫn không được vượt quá 150 kí tự',
                'logoImg.required'=>'Logo không được để trống',
                'logoImg.image'=>'Không đúng định dạng ảnh',
            ];
    }
}
