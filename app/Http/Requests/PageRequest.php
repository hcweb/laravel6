<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $id = $this->get('pageId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'title' => ['required', Rule::unique('pages')->ignore($id)],
                    'alias' => ['required', Rule::unique('pages')->ignore($id),'regex:/^[a-zA-Z0-9_-]+$/u'],
                    'views' => 'numeric',
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required|unique:pages',
                    'alias' => 'required|unique:pages|regex:/^[a-zA-Z0-9_-]+$/u',
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

            'alias.required' => '调用名称不能为空',
            'alias.unique' => '调用名称已经存在',
            'alias.regex' => '调用名称只能为英文数组或者_或者-',

            'views.numeric' => '浏览次数必须为数字',
        ];
    }
}
