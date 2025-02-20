<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use App\RouteHit;

class TrackApiHits
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
        if($request->is('api*')){

        $routename = $request->path();

        RouteHit::firstOrCreate(
        ['route_name'=> $routename],
            ['hit_count'=>0]
            );

        RouteHit::increment('hit_count');
    }

        return $next($request);
    }

}
