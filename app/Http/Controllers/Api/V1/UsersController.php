<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\RegisterEvent;
use App\Http\Requests\Api\RegisterRequest;
use App\User;
use App\UserData;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * 账密注册
     * 判断新注册用户名为邮箱或手机号码
     * 写入新用户数据
     *
     * @param RegisterRequest $request
     * @return $this
     */
    public function store(RegisterRequest $request)
    {
        $username = $request->username;
        $user = [];
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $exist = User::where('email', $username)->first();
            if ($exist) {
                return $this->response->error('用户已存在', 422);
            }

            $user['email'] = $username;
        } elseif (preg_match("/^1[3456789]\d{9}$/", $username)) {
            $exist = User::where('cellphone', $username)->first();
            if ($exist) {
                return $this->response->error('用户已存在', 422);
            }

            $user['cellphone'] = $username;
        } else {
            return $this->response->error('注册用户名须为合法的邮箱或手机号码', 422);
        }

        DB::beginTransaction();
        try {
            $user['password'] = bcrypt($request->password);
            $user = User::create($user);
            UserData::create([
                'user_id' => $user->id,
            ]);

            event(new RegisterEvent($user));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->response->errorInternal('账密注册出错');
        }

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }

}
