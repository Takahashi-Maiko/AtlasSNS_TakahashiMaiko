<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;   //trueに変更しなければ表示されない。(最初は自動的にfalseになっている。)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()   //バリテーション条件の定義
    {
        return [
            //項目=> required(入力必須)
        'username' => 'required|string|min:2|max:12',
        'mail' => 'required|string|min:5|max:40|unique:users,mail|email',
        'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|comfirmed:password',
        'password_confimation' => 'required|regex:/^[0-9a-zA-Z]+$/|min:8|max:20',    //regex:/^[a-zA-Z0-9]+$/=正規表現の「半角英数字のみ(空文字OK)」
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名は入力必須です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以下で入力してください。',

            'mail.required' => 'メールアドレスは入力必須です。',
            'mail,min' => 'メールアドレスは5文字以上で入力してください。',
            'mail.max' => 'メールアドレスは20文字以下で入力してください。',
            'mail.unique' => '登録済みのメールアドレスは使用不可です。',
            'mail.email' => 'メールアドレスの形式で入力してください。',

            'password.required' => 'パスワードは入力必須です。',
            'password.regex' => 'パスワードは英数字のみで入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' =>'パスワードは20文字以下で入力してください。',
            'password.comfirmed' => 'パスワードが一致していません。'
        ];
    }
}
