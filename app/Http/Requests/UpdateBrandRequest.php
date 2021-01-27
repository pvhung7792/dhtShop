<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        // dd(request()->all());
        return [
                'name'=>[
                    'required',
                    'max:100',
                    'regex:/^[\w\s]*$/u',
                    Rule::unique('brands', 'name')->where(function ($query){
                        return $query->where('category_id', request()->category_id)->where('id', '!=', $this->id);
                    }),
                ],
                'slug'=>[
                    'required',
                    'max:150',
                    Rule::unique('brands', 'slug')->where(function ($query){
                        return $query->where('category_id', request()->category_id)->where('id', '!=', $this->id);
                    }),
                ],
                'logoImg'=>'image',
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
                'logoImg.image'=>'Không đúng định dạng ảnh',
            ];
    }
}
