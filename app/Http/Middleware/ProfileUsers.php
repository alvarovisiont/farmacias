<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class ProfileUsers
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
        if(Auth::user()->nivel > 1)
        {
            return redirect()->route('home')->with([
                'flash_message' => 'No tiene acceso para esas rutas',
                'flash_class'   => 'alert-danger'
            ]);
        }
        return $next($request);
    }
}
