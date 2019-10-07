<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkCateRequest extends FormRequest
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
        $id = $this->get('id');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('links')->ignore($id)],
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:links',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空！',
            'name.unique' => '名称已经存在！',
        ];
    }
}
