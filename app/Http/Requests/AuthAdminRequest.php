<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRequest extends FormRequest
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
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:6',
            'name'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute bắt buộc phải nhập',
            'email'=>'Email không đúng định dạng',
            'min'=>':attribute tối thiểu :min ký tự',
            'unique'=>'Email đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'name'=>'Họ và tên',
        ];
    }
}
