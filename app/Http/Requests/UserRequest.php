<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = trim($this->request->get('userId'));
        switch (request()->method()) {
            case 'PUT':
                return [
                    'role' => 'required',
                    'name' => ['required','between:3,12',Rule::unique('users')->ignore($id)],
                    'tel' => 'regex:/^1[34578][0-9]{9}$/',
                    'password' => 'required|between:6,18|confirmed',
                    'email' => ['required','email', Rule::unique('users')->ignore($id)]
                ];
                break;
            case 'POST':
                return [
                    'role' => 'required',
                    'name' => 'required|between:3,12|unique:users',
                    'tel' => 'regex:/^1[34578][0-9]{9}$/',
                    'password' => 'required|between:6,18|confirmed',
                    'email' => 'required|email|unique:users'
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'role.required' => '角色不能为空！',
            'name.required' => '用户名不能为空！',
            'name.unique' => '用户名已经存在！',
            'name.between' => '用户名长度在3到12个字符之间！',
            'tel.regex' => '手机号不正确！',
            'email.required' => '邮箱不能为空！',
            'email.email' => '邮箱格式不正确！',
            'email.unique' => '邮箱已被使用,请换个邮箱试试！',
            'password.required' => '密码不能为空！',
            'password.between' => '密码长度在6到18个字符之间！',
            'password.confirmed' => '两次密码不一致！',
        ];
    }
}
