<?php

namespace App\Http\Middleware;

use Closure;

class managermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('role')) {
            if(session('role') == 2){
                return $next($request);
            } else {
                // 返回1  为当前用户是用户，但不是管理员
                return response()->json(['logined' => 1], 200);
            }
        } else {
            return response()->json(['logined' => 0], 200);
        }
    }
}
