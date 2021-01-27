<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProDetailRequest extends FormRequest
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
            'price'=>'required|numeric|gt:0',
            'sale_price'=>'nullable|numeric|gt:0|lt:price',
            'ram'=>'required',
            'cpu'=>'required',
            'memory'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'price.required'=>'Giá sản phẩm không được để trống',
            'ram.required'=>'Không được để trống',
            'cpu.required'=>'Không được để trống',
            'memory.required'=>'Không được để trống',
            'price.required'=>'Giá sản phẩm không được để trống',
            'price.gt'=>'Giá gốc phải lớn hơn 0',
            'price.numeric'=>'Giá nhập vào phải là số',
            'sale_price.numeric'=>'Giá nhập vào phải là số',
            'sale_price.lt'=>'Giá khuyến mại phải nhỏ hơn giá gốc',
            'sale_price.gt'=>'Giá khuyến mại phải lớn hơn 0',
        ];
    }
}
