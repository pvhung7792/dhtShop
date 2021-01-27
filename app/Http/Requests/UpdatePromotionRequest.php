<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
            'name'=>'required|max:200|regex:/^[\w\s]*$/u|unique:promotions,name,'.$this->segment(3),
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên chương trình khuyến mại',
            'name.unique'=>'Tên chương trình khuyến mại đã tồn tại',
        ];
    }
}
