<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => ['serializer:array', 'bindings', 'change-locale', 'cors']
], function($api) {

    // 登录相关接口
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 短信验证码
        $api->post('sms', 'SmsController@store')
            ->name('api.sms.store');

        // 账密注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 账密登录
        $api->post('email/auth', 'AuthController@emailStore')
            ->name('api.email.auth.store');
    });

});