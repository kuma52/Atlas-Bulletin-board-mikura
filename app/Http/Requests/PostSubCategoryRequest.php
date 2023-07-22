<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSubCategoryRequest extends FormRequest
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
            //
            'main_category' =>
            'required|exists:post_main_categories,id', //「登録されているメインカテゴリ―か」=メインカテゴリ―テーブルに実在するid
            'new_sub_category' => 'required|max:100|string|unique'
        ];
    }

    public function messages()
    {
        return [
            //main_category
            'main_category.required' => 'メインカテゴリーは必須です',
            'main_category.exists' => 'メインカテゴリーが無効です',
            //sub_category
            'new_sub_category.required' => '新しいサブカテゴリ―を入力してください',
            'new_sub_category.max' => '100文字以内にしてください',
            'new_sub_category.string' => '入力内容が無効です',
            'new_sub_category.unique' => 'すでに登録されたサブカテゴリ―です'
        ];
    }
}
