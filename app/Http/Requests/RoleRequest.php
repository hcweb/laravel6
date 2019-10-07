<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
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
        $id=$this->get('roleId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('roles')->ignore($id)],
                    'display_name' => ['required', Rule::unique('roles')->ignore($id)],
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:roles',
                    'display_name' => 'required|unique:roles',
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
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if (empty($this->input('permissions'))){
            $validator->errors()->add('permission','权限不能为空！');
        }
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
