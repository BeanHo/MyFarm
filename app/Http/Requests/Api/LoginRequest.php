<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'username' => 'required',
            'password' =>'required|min:6',
        ];
    }

    public function attributes()
    {
        if (\App::isLocale('zh-CN')) {
            return [
                'username' => '用户名',
                'password'  => '密码',
            ];
        }
        return [];
    }
}
