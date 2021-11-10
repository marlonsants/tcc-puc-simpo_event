<?php

namespace App\Http\Middleware;

use Closure;

class VerificaAcessoDoAutor
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
        if(session('acesso_id') == 1 || session('acesso_id') == 2 ){
            return $next($request);    
        }else{
            return redirect()->back();
        }
    }
}
