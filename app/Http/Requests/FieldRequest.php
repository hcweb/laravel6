<?php

namespace App\Http\Requests;

use App\Models\Field;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FieldRequest extends FormRequest
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
        $mould_id = $this->get('mould_id');
        $id = $this->get('fieldId');

        switch (request()->method()) {
            case 'PUT':
                return [
                    'mould_id' => 'required',
                    'title' => ['required', 'max:50', Rule::unique('fields')->ignore($id)->where(function ($query) use ($mould_id) {
                        return $query->where('mould_id', $mould_id);
                    })],
                    'name' => ['required', 'max:50', 'regex:/^[a-zA-Z]\w{1,11}$/', Rule::unique('fields')->ignore($id)->where(function ($query) use ($mould_id) {
                        return $query->where('mould_id', $mould_id);
                    })],
                    'type' => 'required',
                    'order' => 'numeric',
                ];
                break;
            case 'POST':
                return [
                    'mould_id' => 'required',
                    'title' => ['required', 'max:50', Rule::unique('fields')->where(function ($query) use ($mould_id) {
                        return $query->where('mould_id', $mould_id);
                    })],
                    'name' => ['required', 'max:50', 'regex:/^[a-zA-Z]\w{1,11}$/', Rule::unique('fields')->where(function ($query) use ($mould_id) {
                        return $query->where('mould_id', $mould_id);
                    })],
                    'type' => 'required',
                    'order' => 'numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'mould_id.required' => '模型不能为空!',
            'title.required' => '字段标题不能为空!',
            'title.max' => '字段标题最大为50个字符!',
            'title.unique' => '字段标题已存在,换个试试呗!',
            'name.required' => '字段名称不能为空!',
            'name.max' => '字段名称最大为50个字符!',
            'name.regex' => '字段名称以字母开头，长度在2~12之间，只能包含字母、数字和下划线!',
            'name.unique' => '字段名称已存在,换个试试呗!',
            'type.required' => '字段类型不能为空!',
            'order.numeric' => '排序只能为数字!',
        ];
    }
}
