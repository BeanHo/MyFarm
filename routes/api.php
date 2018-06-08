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
    'middleware' => ['serializer:array', 'bindings']
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
        $api->post('account/auth', 'AuthController@store')
            ->name('api.account.auth.store');
        // 刷新token
        $api->put('auth/current', 'AuthController@update')
            ->name('api.auth.update');
        // 删除token
        $api->delete('auth/current', 'AuthController@destroy')
            ->name('api.auth.destroy');
    });

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 游客可以访问的接口
        // 金豆排行榜
        $api->get('goldlist', 'UsersController@indexOfGoldbean')
            ->name('api.user.goldlist');
        // 土豆排行榜
        $api->get('potatolist', 'UsersController@indexOfPotato')
            ->name('api.user.potatolist');
        // 文章列表
        $api->get('articles', 'ArticlesController@index')
            ->name('api.article.index');

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 更新用户信息
            $api->put('user', 'UsersController@update')
                ->name('api.user.update');
            // 实名认证
            $api->put('realname', 'UsersController@updateRealname')
                ->name('api.user.realname');
            // 设置支付密码
            $api->put('paypwd', 'UsersController@updatePaypwd')
                ->name('api.user.paypwd');
            // 邀请关系
            $api->put('invite', 'UsersController@beInvited')
                ->name('api.user.invite');

            // 金豆收支明细
            $api->get('gold', 'GoldbeanLogsController@index')
                ->name('api.goldlog.index');
            // 可采集金豆
            $api->get('gold/collect', 'GoldbeanLogsController@indexToCollect')
                ->name('api.goldlog.index2');
            // 采集金豆
            $api->put('gold/{item}', 'GoldbeanLogsController@update')
                ->name('api.goldlog.update');

            // 土豆收支明细
            $api->get('potatos', 'PotatoLogsController@index')
                ->name('api.potatos.index');

        });
    });




    // 当前登录用户信息
    $api->get('user', 'UsersController@me')
        ->name('api.user.show');

});