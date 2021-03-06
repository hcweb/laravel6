<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerTypeRequest extends FormRequest
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
        $id = $this->get('sellerTypeId');
        switch (request()->method()) {
            case 'PUT':
                return [
                    'order_num' => 'numeric',
                    'name' => ['required', Rule::unique('seller_type')->ignore($id)],
                ];
                break;
            case 'POST':
                return [
                    'order_num' => 'numeric',
                    'name'=>'required|unique:seller_type'
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'name.unique' => '名称已经存在，换个试试呗!',
            'order_num.numeric' => '排序必须为数字'
        ];
    }
}
