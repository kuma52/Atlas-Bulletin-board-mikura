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
        //ここを変更し忘れやすい falseだと効かない
        //このauthorizeメソッドはTestRequestの使用を許可するどうかを設定するためのメソッドです。
        //falseが設定されているということはデフォルトでは使用許可されていない状態です。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|string|max:2500'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'コメントの入力がありません',
            'comment.string' => 'コメントの形式が無効です',
            'comment.max' => 'コメントは2500文字以内にしてください'
        ];
    }
}
