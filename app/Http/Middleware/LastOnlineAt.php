<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LastOnlineAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guest()) {
            return $next($request);
        }

        if(auth()->user()->last_seen->diffInMinutes(now()) !== 0) {
            DB::table("users")
                ->where("id", auth()->user()->id)
                ->update(["last_seen" => now()]);
        }

        return $next($request);
        
    }
}
