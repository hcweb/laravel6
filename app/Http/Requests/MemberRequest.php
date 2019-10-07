<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $tel=$this->request->get('tel');
        $email=$this->request->get('email');

        $id = trim($this->request->get('memberId'));
        switch (request()->method()) {
            case 'PUT':
                $data=[
                    'name' => ['required','between:3,12',Rule::unique('members')->ignore($id)],
                    'password' => 'required|between:6,18|confirmed'
                ];
                if (!is_null($tel)){
                    array_merge($data,[ 'tel' => 'regex:/^1[34578][0-9]{9}$/']);
                }
                if (!is_null($email)){
                    array_merge($data,['email' => ['required','email', Rule::unique('members')->ignore($id)]]);
                }
                return $data;
                break;
            case 'POST':
                $data=[
                    'name' => 'required|between:3,12|unique:members',
                    'password' => 'required|between:6,18|confirmed'
                ];
                if (!is_null($tel)){
                    array_merge($data,[ 'tel' => 'regex:/^1[34578][0-9]{9}$/']);
                }
                if (!is_null($email)){
                    array_merge($data,['email' => 'required|email|unique:members']);
                }
                return $data;
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '会员名不能为空！',
            'name.unique' => '会员名已经存在！',
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
