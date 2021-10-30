<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUsuarios
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

        if($request->is('rfq/cotacao/nova')){          
            //Cookie::queue('leaveUser', 1, 43800);                             
            //Cookie::queue('leaveUser', 1, 1);                             
        }

        if (false == Auth::guard('sistema')->check()) {
            return redirect()->route('sistema.auth');
        }
        // $request->user('sistema');

        return $next($request);
    }
}
