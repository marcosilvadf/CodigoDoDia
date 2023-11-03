<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PrefixMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $prefix = $request->route()->getPrefix();
        session(['prefixo' => $prefix]);
        
        return $next($request);
    }
}
