<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkRequest extends FormRequest
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
        $rules = [
            'link_id' => 'required',
            'title' => 'required',
            'url' => 'required|url',
            'order' => 'integer',
        ];

        if ($this->request->get('user_phone') != null) {
            $rules['user_phone']='regex:/^1[34578][0-9]{9}$/';
        }
        if ($this->request->get('user_email') !=null) {
            $rules['user_email']='email';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'link_id.required' => '请选择分类!',
            'title.required' => '标题不能为空!',
            'url.required' => '链接地址不能为空!',
            'url.url' => '链接地址不正确!',
            'user_phone.regex' => '手机号码不正确!',
            'user_email.email' => '邮箱格式不正确!',
            'order.integer' => '排序只能是整数!',
        ];
    }
}
