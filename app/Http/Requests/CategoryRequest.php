<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $id=$this->get('categoryId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'title' => ['required', Rule::unique('categories')->ignore($id)],
                    'alias' => ['required', Rule::unique('categories')->ignore($id)],
                   // 'route' => 'required',
                    'order' => 'numeric',
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required|unique:categories',
                    'alias' => 'required|unique:categories',
                  //  'route' => 'required',
                    'order' => 'numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.unique' => '标题名称已经存在',
            'title.between' => '标题长度在3~30之间',
            //'route.required' => '路由名称不能为空',
            'order.numeric' => '排序必须为数字',
            'alias.required' => '调用名称不能为空',
            'alias.unique' => '调用名称已经存在',
        ];
    }
}
