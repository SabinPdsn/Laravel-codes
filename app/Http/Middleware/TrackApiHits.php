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
            $routename = Route::currentRouteName() ?? $request->path();
            $parsed_route = parse_url($routename);

            $path_without_last_digit = preg_replace('/\/\d+$/','',$parsed_route['path']);
            RouteHit::firstOrCreate(
            ['route_name' => $path_without_last_digit],
                ['hit_count'=>0]
            )->increment('hit_count');
        }

        return $next($request);
    }
}
