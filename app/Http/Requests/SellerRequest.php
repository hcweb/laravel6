<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerRequest extends FormRequest
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
        $id = $this->get('sellerId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('seller')->ignore($id)],
                    'typeid' => 'required',
                    'logo' => 'required',
                    'wx' => 'required',
                    'telphone' =>  'required|regex:/^1[34578][0-9]{9}$/',
                    'email' => ['required','email', Rule::unique('seller')->ignore($id)]
                ];
                break;
            case 'POST':
                $data= [
                    'typeid' => 'required',
                    'name'=>'required|unique:seller',
                    'logo' => 'required',
                    'wx' => 'required',
                    'telphone' => 'required|regex:/^1[34578][0-9]{9}$/',
                    'email' => 'required|email|unique:seller'
                ];

                return $data;
                break;
        }
    }

    public function messages()
    {
        return [
            'typeid.required' => '商家类别不能为空',
            'name.required' => '商家名称不能为空',
            'name.unique' => '商家名称已经存在，换个试试呗!',
            'logo.required' => '商家logo不能为空',
            'typeid.required' => '商家类别不能为空',
            'wx.required' => '商家微信不能为空',
            'telphone.required' => '商家手机号不能为空',
            'telphone.regex' => '商家手机号格式不正确',
            'email.required' => '邮箱不能为空！',
            'email.email' => '邮箱格式不正确！',
            'email.unique' => '邮箱已被使用,请换个邮箱试试！',
        ];
    }
}
