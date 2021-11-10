<?php

namespace App\Http\Middleware;

use Closure;

class VerificaAcessoDoAvaliador
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
        if(session('acesso_id') == 2){
            return $next($request);    
        }else{
            return redirect()->back();
        }
        
    }
}
