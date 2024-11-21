<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

class AuthController extends Controller
{
    public Function login(UserRequest $request){
        // TODO : 비밀번호 체크 다음주

        return response()->json([
            'account' => $request->account
            ,'password' => $request->password
        ]);
    }
}