<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:30|',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|between:8,30|confirmed',
        ];
    }

    public function messages()
    {
        return [
            //ユーザー名
            'username.required' => 'ユーザー名の入力は必須です',
            'username.string' => 'ユーザー名が無効な入力です',
            'username.max' => 'ユーザー名は30文字以内で入力してください',

            //address
            'email.required' => 'メールアドレスの入力は必須です',
            'email.max' => 'メールアドレスは100文字以内で入力してください',
            'email.email' => 'メールアドレスの形式が無効です',
            'email.unique' => '登録済みのメールアドレスです',

            //パスワード
            'password.required' => 'パスワードの入力は必須です',
            'password.between' => 'パスワードは8~30文字にしてください',
            'password.confirmed' => 'パスワードと確認用が一致しません',
        ];
    }
}
