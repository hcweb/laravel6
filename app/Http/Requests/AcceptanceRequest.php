<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptanceRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'dept' => 'required',
            'bname' => 'required',
            'isbn' => 'required',
            'uprice' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'required|integer',
        ];
        if ($this->request->get('tel') != null) {
            $rules['tel'] = 'regex:/^1[34578][0-9]{9}$/';
        }
        if ($this->request->get('number') != null) {
            $rules['number'] = 'integer';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'=>'姓名不能为空!',
            'dept.required'=>'部门/科室不能为空!',
            'bname.required'=>'书名不能为空!',
            'isbn.required'=>'ISBN不能为空!',
            'uprice.required'=>'单价不能为空!',
            'uprice.integer'=>'单价格式不正确!',
            'price.required'=>'总价不能为空!',
            'price.integer'=>'总价格式不正确!',
            'discount.required'=>'折扣不能为空!',
            'discount.integer'=>'折扣格式不正确!',
            'tel.regex'=>'手机号格式不正确!',
            'number.integer'=>'数量格式不正确!',
        ];
    }
}
