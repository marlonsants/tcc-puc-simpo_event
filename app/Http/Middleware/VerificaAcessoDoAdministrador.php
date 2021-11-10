<?php

namespace App\Http\Middleware;

use Closure;

class VerificaAcessoDoAdministrador
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
        if(session('acesso_id') == 3 || session('acesso_id') == 4){
            return $next($request);    
        }else{
            return redirect()->back();
        }
    }
}
