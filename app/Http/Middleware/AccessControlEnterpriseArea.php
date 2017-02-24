<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AccessControlEnterpriseArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard='enterprises')
    {
        if (!Auth::guard($guard)->check()) {
            return response('Acesso negado!', 403);
        }
        return $next($request);
    }
}
