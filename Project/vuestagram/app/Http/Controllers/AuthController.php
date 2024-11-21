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
        
        

        // return response()->json([
        //     'account' => $request->account
        //     ,'password' => $request->password
        // ]);

        return 'test';
    }
}