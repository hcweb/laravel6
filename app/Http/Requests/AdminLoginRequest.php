<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'username'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '邮箱不能为空！',
            'password.required' => '密码不能为空！',
            'captcha.required' => '验证码不能为空！',
            'captcha.captcha' => '验证码不正确！'
        ];
    }
}
