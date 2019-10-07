<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MouldRequest extends FormRequest
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
        $tableNames=\DB::getDoctrineSchemaManager()->listTableNames();
        $id=$this->get('mouldId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'name' => ['required','max:50',Rule::unique('moulds')->ignore($id)],
                    'table_name' => ['required','regex:/^[a-zA-Z]\w{1,11}$/',Rule::unique('moulds')->ignore($id)],
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|max:10|unique:moulds',
                    'table_name' => 'required|regex:/^[a-zA-Z]\w{1,11}$/|unique:moulds|not_in:'.implode(',',$tableNames),
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '模型名称不能为空',
            'name.max' => '模型名称最大长度为50个字符',
            'name.unique' => '模型名称已经存在，换个试试呗!',

            'table_name.required' => '模型标识不能为空',
            'table_name.regex' => '模型标识以字母开头，长度在2~12之间，只能包含字母、数字和下划线',
            'table_name.unique' => '模型标识已经存在，换个试试呗!',
            'table_name.not_in' => '模型标识已经在数据库中存在，换个试试呗!',
        ];
    }
}
