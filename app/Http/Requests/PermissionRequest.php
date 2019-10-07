<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
        $id=$this->get('permissionId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('permissions')->ignore($id)],
                    'display_name' => ['required', Rule::unique('permissions')->ignore($id)],
                    'url' => ['required', Rule::unique('permissions')->ignore($id)],
                    'menu_id' => 'required',
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:permissions',
                    'display_name' => 'required|unique:permissions',
                    'url' => 'required|unique:permissions',
                    'menu_id' => 'required',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空！',
            'name.unique' => '名称已经存在！',
            'display_name.required' => '别名不能为空！',
            'display_name.unique' => '名称已经存在！',
            'url.required' => 'url不能为空！',
            'url.unique' => 'url已经存在！',
            'menu_id.required' => '栏目不能为空！',
        ];
    }
}
