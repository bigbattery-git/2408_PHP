<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use MyToken;

class AuthController extends Controller
{
    public Function login(UserRequest $request){
        // TODO : 비밀번호 체크 다음주

        $userInfo = User::where('account', $request->account)->first();

        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        $response =[
            'success' => true
            ,'msg' => '로그인 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];

        return response()->json($response, 200);
    }
}