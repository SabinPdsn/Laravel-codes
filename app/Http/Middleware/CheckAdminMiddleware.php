<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
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
        $Authenticated_user = Auth::user();
        if($Authenticated_user && $Authenticated_user->type === 'admin'){
            return $next($request);
        }

        return response()->json([
            'Unauthorized access'
        ]);
    }
}
