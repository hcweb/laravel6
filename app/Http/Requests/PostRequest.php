<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $id = $this->get('postId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'title' => ['required', Rule::unique('posts')->ignore($id)],
                    'alias' => ['required', Rule::unique('posts')->ignore($id),'regex:/^[a-zA-Z_-]+$/u'],
                    'category_id' => 'required',
                    'order' => 'numeric',
                    'views' => 'numeric',
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required|unique:posts',
                    'alias' => 'required|unique:posts|regex:/^[a-zA-Z_-]+$/u',
                    'category_id' => 'required',
                    'order' => 'numeric',
                    'views' => 'numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'category_id.required' => '栏目不能为空',
            'title.required' => '标题不能为空',
            'title.unique' => '标题名称已经存在',
            'title.between' => '标题长度在3~30之间',
            'alias.required' => '调用名称不能为空',
            'alias.unique' => '调用名称已经存在',
            'alias.unique' => '调用名称已经存在',
            'alias.regex' => '调用名称只能为英文',
            'order.numeric' => '排序必须为数字',
            'views.numeric' => '浏览次数必须为数字',
        ];
    }
}
