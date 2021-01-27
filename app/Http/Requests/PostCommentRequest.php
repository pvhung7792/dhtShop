<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
            'question'=>'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'question.required'=>'Vùi lòng nhập bình luận trước khi gửi',
            'question.max'=>'Không vượt quá 255 ký tự',
        ];
    }
}
