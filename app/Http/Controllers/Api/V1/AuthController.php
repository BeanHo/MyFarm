<?php

namespace App\Http\Controllers\Api\V1;


use App\Events\LoginEvent;
use App\Http\Requests\Api\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 账密登录
     *
     * @param LoginRequest $request
     */
    public function store(LoginRequest $request)
    {
        $username = $request->username;
        filter_var($username, FILTER_VALIDATE_EMAIL)
            ? $credentials['email'] = $username
            : $credentials['cellphone'] = $username;
        $credentials['password'] = $request->password;

        if(!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }

        $user = User::where('email', $request->username)->first();
        event(new LoginEvent($user));
        return $this->respWithToken($token)->setStatusCode(201);
    }

    /**
     * 登录返回封装
     *
     * @param $token
     * @return mixed
     */
    protected function respWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
