<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sub_category_id' => 'required',
            'title' => 'required|max:100|string',
            'post' => 'required|string|max:5000',
        ];
    }

    public function messages()
    {
        return [
            //サブカテゴリ
            'sub_category_id.required' => 'サブカテゴリ―は必須です',

            //タイトル
            'title.required' => 'タイトルは必須です',
            'title.max' => 'タイトルは100文字以内にしてください',
            'title.string' => 'このタイトルは無効です',

            //post
            'post.required' => '投稿内容の入力は必須です',
            'post.max' => '投稿内容は5000文字以内にしてください',
        ];
    }
}
