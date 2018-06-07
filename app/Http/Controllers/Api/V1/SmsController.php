<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\SmsRequest;
use App\User;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;

/**
 * SMS控制器
 *
 * Class SmsController
 * @package App\Http\Controllers\Api\V1
 */
class SmsController extends Controller
{
    /**
     * 发送短信验证码
     *
     * @param SmsRequest $request
     * @param EasySms $easySms
     */
    public function store(SmsRequest $request, EasySms $easySms)
    {
        $types = ['1'=>'登录', '2'=>'注册', '3'=>'设置支付密码'];
        $cellphone = $request->cellphone;
        $type = $types[$request->type];

        $existUser = User::where('cellphone', $cellphone)->first();
        if (2 == $request->type && $existUser) {
            return $this->errorResponse(422, '该手机号已注册，请更换其他手机号', 3008);
        }

        if(!app()->environment('production')) {
            $code = '666666';
        } else {
            // 生成6位随机数，左侧补0
            $code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);

            try {
                $easySms->send($cellphone, [
                    'content'  => '尊敬的${name}会员,您的${type}验证码为${code},请在${time_out}内正确填写',
                    'template' => 'SMS_48795019',
                    'data' => [
                        'name' => substr_replace($cellphone, '****', 3, -4),
                        'type' => $type,
                        'code' => $code,
                        'time_out' => '5分钟'
                    ],
                ]);
            } catch (ClientException $exception) {
                $response = $exception->getResponse();
                $result = json_decode($response->getBody()->getContents(), true);
                return $this->response->errorInternal($result['msg'] ?? trans('sms.failed'));
            }
        }

        // 缓存验证码 5分钟过期
        $key = 'Sms_'. $cellphone;
        $expiredAt = now()->addMinutes(5);
        Cache::put($key, $code, $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
