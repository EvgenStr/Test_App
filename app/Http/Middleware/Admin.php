<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\TwitterStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

//    функция проверки прав пользователя, если не админ то перенаправляет на хоум
//админ root ==1 ; user root == 0;
    public function handle($request, Closure $next)
    {
        if (Auth::user()->root == 0) {
            return redirect(route('home'));
        }
        return $next($request);
    }
}