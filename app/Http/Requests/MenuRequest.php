<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
        $id=$this->get('menuId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'title' => ['required','between:3,30',Rule::unique('menus')->ignore($id)],
                    //'route' => 'required',
                    'order' => 'numeric',
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required|between:3,30|unique:menus',
                    //'route' => 'required',
                    //'parent_id' => 'required',
                    'order' => 'numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.between' => '标题长度在3~30之间',
            'title.unique' => '标题已经存在，换个试试呗!',
            'route.required' => '路由名称不能为空',
            'order.numeric' => '排序必须为数字'
        ];
    }
}
