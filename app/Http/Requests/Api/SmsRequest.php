<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class SmsRequest extends FormRequest
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
            'cellphone' => 'required|regex:/^1[3456789]\d{9}$/',
            'type' => 'required',
        ];
    }

    public function attributes()
    {
        if (\App::isLocale('zh-CN')) {
            return [
                'cellphone' => '手机号码',
                'type' => '验证类型',
            ];
        }
        return [];
    }
}
