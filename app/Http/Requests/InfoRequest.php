<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name'=>'required|min:6',
            'phone'=>'required|numeric',
            'address'=>'required|string|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'required'=>'Trường :attribute bắt buộc phải nhập',
            'min'=>'Trường :attribute tối thiểu :min ký tự',
            'string'=>'Trường :attribute phải là chuỗi',
            'numeric'=>'Trường :attribute phải là số',
        ];
    }
    public function attributes()
    {
        return [
            'user_name'=>'họ và tên',
            'phone'=>'số điện thoại',
            'address'=>'địa chỉ',
        ];
    }
    
}
