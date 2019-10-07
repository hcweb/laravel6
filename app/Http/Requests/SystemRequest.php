<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SystemRequest extends FormRequest
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
        $id = trim($this->request->get('systemId'));
        switch (request()->method()) {
            case 'PUT':
                return [
                    'title' => ['required',Rule::unique('systems')->ignore($id)],
                    'name' => ['required','regex:/^[a-zA-Z_-]+$/u',Rule::unique('systems')->ignore($id)],
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required|unique:systems',
                    'name' => 'required|regex:/^[a-zA-Z_-]+$/u|unique:systems',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空！',
            'title.unique' => '标题已被使用,请换个试试！',
            'name.required' => '调用别名不能为空！',
            'name.unique' => '调用别名已被使用,请换个试试！',
            'name.regex' => '调用别名格式不正确,只能为字母或下划线！',
        ];
    }
}
