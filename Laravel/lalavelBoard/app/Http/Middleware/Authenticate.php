<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // 로그인 안되어있으면 라우트 이름 'goLogin'으로 이동할 것
        if (! $request->expectsJson()) {
            return route('goLogin');
        }
    }
}
