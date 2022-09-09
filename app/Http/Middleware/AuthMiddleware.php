<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class AuthMiddleware
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

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }

        if(!is_null(session()->get('email'))) {
            return $next($request);
        } else {
            return redirect()->route('site.principal')->with('error', 'É necessário realizar login');
            session_destroy();
        }
        
        
    }
}
