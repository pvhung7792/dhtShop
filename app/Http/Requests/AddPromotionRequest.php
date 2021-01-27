<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPromotionRequest extends FormRequest
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
            'name'=>'required|unique:promotions|max:200|regex:/^[\w\s]*$/u',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên chương trình khuyến mại',
            'name.unique'=>'Chương trình khuyến mại đã tồn tại',
        ];
    }
}
